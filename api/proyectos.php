<?php
include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

// Reemplazamos PATH_INFO por query string (más compatible)
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

function getInput() {
    return json_decode(file_get_contents("php://input"), true);
}

// NOTA DE ARQUITECTURA:
// Este API enruta todas las operaciones de escritura (Crear, Actualizar, Borrar)
// a través del método POST. Esto es una solución intencionada para evadir
// restricciones de seguridad del servidor (como mod_security o configuraciones de Apache)
// que a menudo bloquean los métodos PUT, PATCH y DELETE por defecto en entornos de
// hosting compartido. La lógica dentro del caso 'POST' distingue la operación
// a realizar basándose en los parámetros de la URL.
switch ($method) {
    case 'GET':
        if ($id) {
            $res = $conn->query("SELECT * FROM proyectos WHERE id=$id");
            echo json_encode($res->fetch_assoc());
        } else {
            $res = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC");
            $out = [];
            while ($row = $res->fetch_assoc()) {
                $out[] = $row;
            }
            echo json_encode($out);
        }
        break;

    case 'POST':
        // Lógica de enrutamiento para el método POST:
        // 1. Si la URL contiene ?action=delete -> Se interpreta como BORRADO.
        // 2. Si la URL contiene ?id=...      -> Se interpreta como ACTUALIZACIÓN.
        // 3. Si no contiene ninguno de los anteriores -> Se interpreta como CREACIÓN.

        // --- MANEJO DE BORRADO (DELETE) ---
        if (isset($_GET['action']) && $_GET['action'] === 'delete') {
            if ($id) {
                $conn->query("DELETE FROM proyectos WHERE id=$id");
                echo json_encode(["success" => true, "action" => "deleted", "affected_rows" => $conn->affected_rows]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "ID no especificado para DELETE"]);
            }
            break; // Salimos del case POST
        }

        // --- MANEJO DE ACTUALIZACIÓN (UPDATE) vs CREACIÓN (CREATE) ---
        if ($id) {
            $d = getInput();
            if (is_null($d)) {
                http_response_code(400);
                echo json_encode(["error" => "JSON inválido o vacío para actualizar"]);
                exit;
            }

            $sets = [];
            foreach ($d as $k => $v) {
                // Solo actualizar los campos que se envían en el JSON
                if (!empty($v)) {
                    $sets[] = "$k='" . $conn->real_escape_string($v) . "'";
                }
            }

            if (empty($sets)) {
                http_response_code(400);
                echo json_encode(["error" => "No se enviaron campos para actualizar"]);
                exit;
            }

            $sql = "UPDATE proyectos SET " . implode(",", $sets) . " WHERE id=$id";
            $conn->query($sql);
            echo json_encode([
                "success" => true,
                "affected_rows" => $conn->affected_rows
            ]);

        } else {
            // Lógica de CREACIÓN (INSERT)
            $d = getInput();
            $stmt = $conn->prepare("INSERT INTO proyectos (titulo, descripcion, url_github, url_produccion, imagen) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $d['titulo'], $d['descripcion'], $d['url_github'], $d['url_produccion'], $d['imagen']);
            $stmt->execute();
            echo json_encode(["success" => true, "id" => $stmt->insert_id]);
        }
        break;

    case 'PATCH':
        // Deshabilitado intencionalmente. Ver NOTA DE ARQUITECTURA al inicio del switch.
        http_response_code(405);
        echo json_encode(["error" => "Método PATCH no soportado, use POST con un ID para actualizar."]);
        break;

    case 'DELETE':
        // Deshabilitado intencionalmente. Ver NOTA DE ARQUITECTURA al inicio del switch.
        http_response_code(405);
        echo json_encode(["error" => "Método DELETE no soportado, use POST con ?action=delete."]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>

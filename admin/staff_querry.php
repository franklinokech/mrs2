<?php 

$name = ucwords($staff['first_name']." ".$staff['last_name']);

                    $sql = "SELECT * FROM student_patient ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $patient = count($stmt->fetchAll());

                    $sql = "SELECT * FROM student_patient ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $Patient = count($stmt->fetchAll());

                    $sql = "SELECT * FROM laboratory_test WHERE attended=2 ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $lab_test = count($stmt->fetchAll());

                    $sql = "SELECT * FROM laboratory_test WHERE conducted_by='{$name}' ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $test_by = count($stmt->fetchAll());

                    $sql = "SELECT * FROM visit WHERE attended=3";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $visit_count = count($stmt->fetchAll());

                    $sql = "SELECT * FROM visit WHERE created_by='{$name}' ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $visit = count($stmt->fetchAll());                    

                    $sql = "SELECT * FROM visit WHERE examined_by='{$name}' ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $exam = count($stmt->fetchAll());

                    $sql = "SELECT * FROM treatment WHERE seen_by='{$name}' ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $Seen = count($stmt->fetchAll());

                    $sql = "SELECT * FROM laboratory_test WHERE submited_by='{$name}' ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $submit = count($stmt->fetchAll());

                    $sql = "SELECT * FROM treatment WHERE prescribed_by='{$name}' ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $prescribed_by = count($stmt->fetchAll());

                    $sql = "SELECT * FROM treatment WHERE druged_by='{$name}' ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $drug = count($stmt->fetchAll());

                    $sql = "SELECT * FROM staff WHERE status=1 ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $active = count($stmt->fetchAll());

                    $sql = "SELECT * FROM staff WHERE status=0 ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $inactive = count($stmt->fetchAll());

                    $sql = "SELECT * FROM staff ";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $stafff = count($stmt->fetchAll());

?>
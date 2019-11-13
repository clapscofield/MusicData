<?php
$pdo = new PDO('mysql:host=localhost;dbname=musicoset', 'root', 'saxum#2019');
$sql = "SELECT main_genre, SUM(popularity) as popularity FROM artists WHERE main_genre !='-' AND main_genre IS NOT NULL GROUP BY main_genre ORDER BY SUM(popularity) DESC LIMIT 5";
$stmt = $pdo->query($sql);


           $grafico = array(
                'dados' => array(
                    'cols' => array(
                        array('type' => 'string', 'label' => 'main_genre'),
                        array('type' => 'number', 'label' => 'popularity')
                    ),  
                    'rows' => array()
                ),
                'config' => array(
                    'title' => 'Quantidade de alunos por gênero',
                    'width' => 400,
                    'height' => 300
                )
            );




           while ($obj = $stmt->fetchObject()) {
            $grafico['dados']['rows'][] = array('c' => array(
                array('v' => $obj->main_genre),
                array('v' => (int)$obj->popularity)
            ));
           }


          /*
          echo '<pre>';  
           print_r(json_encode($grafico));  
           echo '</pre>';*/
       
           echo json_encode($grafico);
           exit(0);
?>
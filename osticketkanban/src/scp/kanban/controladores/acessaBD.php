<?php

        



    function conectaTicket()
    {
        $host = 'ticketDB';
        $db   = 'ticket';
        $user = 'root';
        $pass = 'osticket';
        $port = "3306";
        $charset = 'utf8mb4';

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
        try {
            $pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }


    
    //require('../../include/ost-config.php');
    $sql = sprintf('SELECT t.number,
                td.subject,
                t.user_id,
                u.name,
                t.isanswered,
                t.staff_id,
                s.firstname,
                DATE(t.closed) as `closed`
                FROM `ost_ticket` t
                INNER JOIN `ost_ticket__cdata` td USING(ticket_id)
                LEFT JOIN `ost_user` u
                        ON u.id = t.user_id
                LEFT JOIN `ost_staff` s USING (staff_id)
                WHERE DATE(t.closed) IS null
                OR DATE(t.closed) = DATE(now())
                AND 1=1');



        $data = $pdo->query($sql)->fetchAll();
        return $data;
    }
    
    
?>
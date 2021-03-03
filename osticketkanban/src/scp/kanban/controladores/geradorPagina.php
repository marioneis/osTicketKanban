<?php
    //funcoes inicialmente iguais mas prontas para customizações

    function criaCardAberto ($row)
    {
        $ticketNumber =  "#".$row['number'];
        $ticketSubject =  'Assunto: '.$row['subject'];
        $ticketStaff =  'Atribuído: '.$row['firstname'];

        $html = sprintf('<div class="Item" draggable="true">'
                    .$ticketNumber.'<BR/>'
                    .$ticketSubject.'<BR/>'
                    .'<span class="staffName">'
                    .$ticketStaff.'</span> 
                 </div>');        
        return $html;
    }

    function criaCardAtendimento ($row)
    {
        $ticketNumber =  "#".$row['number'];
        $ticketSubject =  'Assunto: '.$row['subject'];        
        $ticketStaff =  'Atribuído: '.$row['firstname'];

        $html = sprintf('<div class="Item" draggable="true">'
                    .$ticketNumber.'<BR/>'
                    .$ticketSubject.'<BR/>'
                    .'<span class="staffName">'
                    .$ticketStaff.'</span> 
                 </div>');        
        return $html;
    }

    function criaCardEncerrado ($row)
    {
        $ticketNumber =  "#".$row['number'];
        $ticketSubject =  'Assunto: '.$row['subject'];
        $ticketStaff =  'Atribuído: '.$row['firstname'];

        $html = sprintf('<div class="Item" draggable="true">'
                    .$ticketNumber.'<BR/>'
                    .$ticketSubject.'<BR/>'
                    .'<span class="staffName">'
                    .$ticketStaff.'</span> 
                 </div>');        
        return $html;
    }


?>
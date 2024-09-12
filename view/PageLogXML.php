<?php

class PageLogXML
{    public function output($pagelogDetails)
    
    {    
        $xml = new XMLWriter();
        $xml->openURI("php://output");
        $xml->startDocument();
        $xml->setIndent(true);
        $xml->startElement('pagelog');
        foreach ($pagelogDetails as $id => $logDetail )  { 
            $xml->startElement('id');
            $xml->writeRaw($logDetail ->id);
            $xml->endElement();
            $xml->endElement();
            
            $xml->startElement('username');
            $xml->writeRaw($logDetail ->username);
            $xml->endElement();
            $xml->endElement();
         }
      
        $xml->endElement();
            $xml->flush();



    }
}

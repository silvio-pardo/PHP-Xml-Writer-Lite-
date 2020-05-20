<?php
/**
 * Created by Silvio Pardo
 * Version: v.0.0.1
 * Date: 20/05/19
 * Time: 19.42
 */

class XmlWriter
{
    private $xml_w;
    const xml_version = '1.0';
    const xml_encoding = 'UTF-8';
    //***************
    //Construttore
    public function __construct(){
        $this->inizialize_writer();
    }
    //XML Writer
    private function inizialize_writer(){
        $this->xml_w = new XMLWriter();
        // inizializzo l'xml writer per lavorare in memoria
        $this->xml_w->openUri('php://output');
        $this->xml_w->setIndent(true);
        $this->xml_w->startDocument('1.0','UTF-8');
    }
    private function create_response($str){
        $this->xml_w->openMemory();
        $this->xml_w->startDocument(self::xml_version, self::xml_encoding);
        $this->xml_w->startElement($str);
    }
    //public function to write element
    public function write_row($element,$result){

        $this->xml_w->startElement($element);

        foreach($result as $key=>$value){
            $this->xml_w->writeElement($key, $value);
        }
        $this->xml_w->endElement();
    }

    public function inizialize_result($startElement){
        $this->xml_w->startElement($startElement);
    }

    public function add_result($result){
        foreach($result as $key=>$value){
            $this->xml_w->writeElement($key, $value);
        }
    }
    //ending element
    public function finalize_result(){
        $this->xml_w->endElement();
    }
    //end of write xml and retrieve
    public function end_response(){
        $this->xml_w->endDocument();
        return $this->xml_w->outputMemory(TRUE);
    }
}
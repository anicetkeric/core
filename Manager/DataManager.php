<?php

/**
 * Created by PhpStorm.
 * User: ANICET ERIC KOUAME
 * Date: 20/01/2017
 * Time: 09:47
 *
 * This file is part of CORE API.
 *
 * CORE API is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 *
 */

require_once  $_SERVER['DOCUMENT_ROOT'].'/core/Data/Data.php';
require_once("Manager.php");

class DataManager extends Manager
{

    /**
     * @var Manager
     */
    private $_db;

    public function __construct() {
        try{
            $this->_db = parent::__construct();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }


    public function selectCustomers() {
        $result =  Array();

        $sql = "SELECT * FROM customer c order by c.firstNameCustommer ASC";
        $requete= $this->_db->prepare($sql);

        try {
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_ASSOC);

            while($ligne = $requete->fetch(PDO::FETCH_ASSOC)) // on r?cup?re la liste
            {
                $result[]=$ligne; //
            }

            if(count($result)>0) // on r?cup?re la liste
            {
                return $result;

            }else{
                return null;
            }


        } catch (Exception $exc) {
            return  -1;
        }
    }


    public function selectOneCustomer($id) {
        $result =  Array();

        $sql = "SELECT * FROM customer c where c.idCustommer=:id";
        $requete= $this->_db->prepare($sql);
        $requete->bindValue(":id", $id);

        try {
            $requete->execute();
            $requete->setFetchMode(PDO::FETCH_ASSOC);


            while($ligne = $requete->fetch(PDO::FETCH_ASSOC)) // on r?cup?re la liste
            {
                $result[]=$ligne; //
            }

            if(count($result)>0) // on r?cup?re la liste
            {
                return $result;

            }else{
                return null;
            }


        } catch (Exception $exc) {
            return  -1;
        }
    }

    public function insertCustomer(Data $customer) {

        $sql = "INSERT INTO `customer`(`firstNameCustommer`, `lastNameCustommer`, `emailCustommer`, `addressCustommer`, `cityCustommer`, `countryCustommer`) VALUES (:fname,:lname,:email,:adr,:city,:country)";

        $requete= $this->_db->prepare($sql);
        $requete->bindValue(":fname", $customer->getFirstNameCustomer());
        $requete->bindValue(":lname",  $customer->getLastNameCustomer());
        $requete->bindValue(":email",  $customer->getEmailCustomer());
        $requete->bindValue(":adr",  $customer->getAddressCustomer());
        $requete->bindValue(":city",  $customer->getCityCustomer());
        $requete->bindValue(":country",  $customer->getCountryCustomer());

        try {

            if($requete->execute()){

                return $this->_db->lastInsertId();

            }else{ return   null;}

        } catch (Exception $exc) {
            return  -1;
        }
    }




}
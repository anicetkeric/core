<?php

/**
 * Created by PhpStorm.
 * User: ANICET ERIC KOUAME
 * Date: 20/01/2017
 * Time: 09:17
 * Copyright 2017 @ EnCode Technologies & Conseils
 *
 * This file is part of CORE API.
 *
 * CORE API is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 */

class Data
{


    private $idCustomer;
    private $firstNameCustomer;
    private $lastNameCustomer;
    private $emailCustomer;
    private $addressCustomer;
    private $cityCustomer;
    private $countryCustomer;

    /**
     * Data constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param mixed $idCustomer
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;
    }

    /**
     * @return mixed
     */
    public function getFirstNameCustomer()
    {
        return $this->firstNameCustomer;
    }

    /**
     * @param mixed $firstNameCustomer
     */
    public function setFirstNameCustomer($firstNameCustomer)
    {
        $this->firstNameCustomer = $firstNameCustomer;
    }

    /**
     * @return mixed
     */
    public function getLastNameCustomer()
    {
        return $this->lastNameCustomer;
    }

    /**
     * @param mixed $lastNameCustomer
     */
    public function setLastNameCustomer($lastNameCustomer)
    {
        $this->lastNameCustomer = $lastNameCustomer;
    }

    /**
     * @return mixed
     */
    public function getEmailCustomer()
    {
        return $this->emailCustomer;
    }

    /**
     * @param mixed $emailCustomer
     */
    public function setEmailCustomer($emailCustomer)
    {
        $this->emailCustomer = $emailCustomer;
    }

    /**
     * @return mixed
     */
    public function getAddressCustomer()
    {
        return $this->addressCustomer;
    }

    /**
     * @param mixed $addressCustomer
     */
    public function setAddressCustomer($addressCustomer)
    {
        $this->addressCustomer = $addressCustomer;
    }

    /**
     * @return mixed
     */
    public function getCityCustomer()
    {
        return $this->cityCustomer;
    }

    /**
     * @param mixed $cityCustomer
     */
    public function setCityCustomer($cityCustomer)
    {
        $this->cityCustomer = $cityCustomer;
    }

    /**
     * @return mixed
     */
    public function getCountryCustomer()
    {
        return $this->countryCustomer;
    }

    /**
     * @param mixed $countryCustomer
     */
    public function setCountryCustomer($countryCustomer)
    {
        $this->countryCustomer = $countryCustomer;
    }




}
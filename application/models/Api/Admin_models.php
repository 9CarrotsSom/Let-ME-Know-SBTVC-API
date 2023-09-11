<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class Admin_models extends CI_Model
{
    public function Login($request)
    {
        $Email = $request["Email"];
        $Password = $request["Password"];

        $sql = "SELECT Uuid, Email, PhoneNumber FROM admin
                WHERE (Email = '$Email' || PhoneNumber = '$Email') && Password = '$Password' && StatusItem = '001'
               ";
        $query = $this->db->query($sql);
        $res = $query->result_array();

        return $res;
    }

    public function CheckJWTToken($Token)
    {
        $sql = "SELECT Id 
				FROM admin
				WHERE Token = '$Token'
		       ";
        $query = $this->db->query($sql);
        $res = $query->result_array();

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateJWTToken($Email, $Token)
    {

        $this->db->set('Token', $Token);
        $this->db->set('UpdatedAt', date('Y-m-d H:i:s'));
        $this->db->set('UpdatedBy', $Email);
        $this->db->where('Email', $Email);
        $query = $this->db->update("admin");

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function CreateItem($request, $Email, $Uuid)
    {
        $EmailCheck = $request["Email"];
        $PhoneNumber = $request["PhoneNumber"];

        $sql = "SELECT Id 
				FROM admin
				WHERE (Email = '$EmailCheck' || PhoneNumber = '$PhoneNumber') && StatusItem = '001'
		       ";
        $query = $this->db->query($sql);
        $res = $query->result_array();

        if (count($res) > 0) {
            return '99';
        } else {
            $this->db->set('Uuid', $Uuid);
            $this->db->set('Email', $request["Email"]);
            $this->db->set('PhoneNumber', $request["PhoneNumber"]);
            $this->db->set('FirstName', $request["FirstName"]);
            $this->db->set('LastName', $request["LastName"]);
            $this->db->set('Password', $request["Password"]);
            $this->db->set('CreatedAt', date('Y-m-d H:i:s'));
            $this->db->set('CreatedBy', $Email);
            $this->db->set('UpdatedAt', date('Y-m-d H:i:s'));
            $this->db->set('UpdatedBy', $Email);

            if ($this->db->insert("admin")) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function RemoveItem($request, $Email)
    {
        $this->db->set('StatusItem', '009');
        $this->db->set('UpdatedAt', date('Y-m-d H:i:s'));
        $this->db->set('UpdatedBy', $Email);
        $this->db->where('Uuid', $request["Uuid"]);
        if ($this->db->delete("admin")) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateItem($request, $Email)
    {
        $EmailNew = $request["Email"];

        $sql = "SELECT Uuid, Email, PhoneNumber FROM admin
                WHERE (Email = '$EmailNew' || PhoneNumber = '$EmailNew')
            ";
        $query = $this->db->query($sql);
        $res = $query->result_array();

        if (count($res) > 0) {
            return false;
        } else {
            $this->db->set('Email', $request["Email"]);
            $this->db->set('PhoneNumber', $request["PhoneNumber"]);
            $this->db->set('FirstName', $request["FirstName"]);
            $this->db->set('LastName', $request["LastName"]);
            $this->db->set('Password', $request["Password"]);
            $this->db->set('UpdatedAt', date('Y-m-d H:i:s'));
            $this->db->set('UpdatedBy', $Email);
            $this->db->where('Uuid', $request["Uuid"]);
            if ($this->db->update("admin")) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function GetItemAll($request)
    {
        $sql = "SELECT id, Uuid, Email, PhoneNumber, FirstName, LastName, UpdatedAt, UpdatedBy FROM admin
                WHERE StatusItem = '001'
            ";
        $query = $this->db->query($sql);
        $res = $query->result_array();

        return $res;
    }
}

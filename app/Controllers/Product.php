<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;//เรียกใช้ Model
use ResourceBundle;

class Product extends ResourceController
{
    use ResponseTrait;
    // get
    public function index()
    {
        $model = new ProductModel();
        $data['product'] = $model->orderBy('_id', 'DESC')->findAll(); //เรียกข้อมูลทั้งหมด จากไอดีที่มีในตาราง เก็บที่ ตัวแปล $data
        return $this->respond($data);//นำตัวแปล $data มาแสดงผล 
    }
    // get by id 
    public function getProID($id = null) //กำหนด ไอดี ให้เป็นค่าว่าง

    {
        $model = new ProductModel();
        $data = $model->where('_id', $id)->first(); //เรียกข้อมูลทั้งหมด จากไอดีที่รับค่าจาก ตัวแปล $id เก็บที่ ตัวแปล $data
        if ($data) {
            return $this->respond($data);//นำตัวแปล $data มาแสดงผล 
        } else {
            return $this->failNotFound('หายังไงก้หาไม่เจอ');
        }
    }
    //insert 
    public function create()
    {
        $model = new ProductModel();
        $data = [
            "name" => $this->request->getVar('name'),//เก็บข้อมูล และ ชื่อ colunm ที่จะเพิ่มข้อมูลเข้าไป
            "category" => $this->request->getVar('category'),//เก็บข้อมูล และ ชื่อ colunm ที่จะเพิ่มข้อมูลเข้าไป
            "price" => $this->request->getVar('price'),//เก็บข้อมูล และ ชื่อ colunm ที่จะเพิ่มข้อมูลเข้าไป
            "tags" => $this->request->getVar('tags')//เก็บข้อมูล และ ชื่อ colunm ที่จะเพิ่มข้อมูลเข้าไป
        ];
        $model->insert($data);//นำค่าที่เก็บไว้ตัวแปล $data เพิ่มเข้าไปยัง ฐานข้อมูล
        $respnse = [
            'status' => 201,
            'error' => null,
            "message" => [
                'success' => 'เพิ่มแล้วน้ะจ้ะ'
            ]
        ];
        return $this->respond($respnse);
    }
    // update
    public function update($id = null)//กำหนด ไอดี ให้เป็นค่าว่าง
    {

        $model = new ProductModel();
        $data = [
            "name" => $this->request->getVar('name'),//เก็บข้อมูล และ ชื่อ colunm ที่จะเปลียนข้อมูลเข้าไป
            "category" => $this->request->getVar('category'),//เก็บข้อมูล และ ชื่อ colunm ที่จะเปลียนข้อมูลเข้าไป
            "price" => $this->request->getVar('price'),//เก็บข้อมูล และ ชื่อ colunm ที่จะเปลียนข้อมูลเข้าไป
            "tags" => $this->request->getVar('tags')//เก็บข้อมูล และ ชื่อ colunm ที่จะเปลียนข้อมูลเข้าไป
        ];
        $model->update($id, $data);//นำค่าที่เก็บไว้ตัวแปล $data เพิ่มเข้าไปยัง ฐานข้อมูล โดยเลือกจาก ไอดี
        $respnse = [
            'status' => 201,
            'error' => null,
            'product' => $data,
            "message" => [
                'success' => 'แก้แล้วน้ะจ้ะ'
            ]
        ];
        return $this->respond($respnse);
    }
    // delete
    public function delete($id = null)//กำหนด ไอดี ให้เป็นค่าว่าง
    {
        $model = new ProductModel();
        $data = $model->find($id);//เลือกข้อมูลจาก ไอดี
        if ($data) {
            $model->delete($id);//ลบข้อมูลทั้ง เลือกจากไอดี
            $respnse = [
                'status' => 201,
                'error' => null,
                // 'product' => $data,
                "message" => [
                    'success' => 'ลบแล้วน้ะจ้ะ'
                ]
               
            ];
            return $this->respond($respnse);
        } else {
            return $this->failNotFound('ลบไม่ได้');
        }
    }
}

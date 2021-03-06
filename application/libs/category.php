<?php

class Category
{
    public function __construct($id, $name, $description, $created_at, $last_edit_at, $img_path, bool $shown_on_display)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->created_at = $created_at;
        $this->last_edit_at = $last_edit_at;
        $this->img_path = $img_path;
        $this->shown_on_dispay = $shown_on_display;
    }

    public function getCategoryId(){
        return $this->id;
    }

    public function getCategoryName(){
        return $this->name;
    }

    public function getCategoryDescription(){
        return $this->description;
    }

    public function getCategoryCreationDate(){
        return $this->created_at;
    }

    public function getCategoryLastEditDate(){
        return $this->last_edit_at;
    }

    public function getCategoryImagePath(){
        return $this->img_path;
    }

    public function isShownOnDisplay(){
        return $this->shown_on_dispay;
    }
}
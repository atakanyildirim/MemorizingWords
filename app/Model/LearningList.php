<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LearningList extends Model
{
    /**
     * LearnWord veritabanı tablosunda her bir kayıtta öğrenilmeye başlandığı tarih bilgisini ekler.
     *
     * @var bool
     */
    public $timestamps = true;
}

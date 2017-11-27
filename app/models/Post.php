<?php
namespace app\models;

class Post extends \yii\base\Object {
    const STEEMIT = 'steemit-post';
    const YOUTUBE = 'youtube-post';
    const TWITTER = 'twitter-post';
    const BBC = 'bbc-post';

    const TYPES = [
        self::STEEMIT,
        'youtube-post',
        'twitter-post',
        'bbc-post'
    ];

    public $data;
    public $authorName;
    public $description;
    public $timestampFmt;
    public $collections;
}


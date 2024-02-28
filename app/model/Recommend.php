<?php
declare(strict_types=1);

namespace app\model;

use think\facade\Config;
use think\Model;

/**
 * @mixin \think\Model
 */
class Recommend extends Model
{
    //
    public function getList(int $page, int $limit)
    {
        $user = $this->getUser($page, $limit);
        $music = $this->getMusic($page, $limit);
        $video = $this->getVideo($page, $limit);
        $article = $this->getArticle($page, $limit);

        $models = ['user', 'music', 'video', 'article'];

        $randModels = $this->getRandomModels($limit, $models);

        $result = [];

        foreach ($randModels as $key => $value) {
            switch ($value) {
                case 'user':
                    $result[$key][$value . 'Entity'] = array_key_exists($key, $user) ? $user[$key] : null;
                    break;
                case 'music':
                    $result[$key][$value . 'Entity'] = array_key_exists($key, $music) ? $music[$key] : null;
                    break;
                case 'video':
                    $result[$key][$value . 'Entity'] = array_key_exists($key, $video) ? $video[$key] : null;
                    break;
                case 'article':
                    $result[$key][$value . 'Entity'] = array_key_exists($key, $article) ? $article[$key] : null;
                    break;
            }
        }


        return $result;
    }

    private function getRandomModels(int $limit, $models)
    {
        // we want ['user', 'user', 'music', 'video', 'music', 'article', 'video], a random model for showing on recommend page.
        $randModels = [];
        for ($i = 0; $i < $limit; $i++) {
            // generate a random number from 0 to limit-1 as the pointer
            $randKey = rand(0, count($models) - 1);
            // put the pointed element from models to the return randModels
            $randModels[$i] = $models[$randKey];
        }

        return $randModels;
    }

    private function getUser(int $page, int $limit)
    {
        $user = new User();
        return $user->where('type', Config::get('utils.TIKTOP_SINGER'))->limit($page, $limit)->select();
    }

    private function getMusic(int $page, int $limit)
    {
        $music = new Music();
        return $music->with('user')->limit($page, $limit)->select();
    }

    private function getVideo(int $page, int $limit)
    {
        $video = new Video();
        return $video->with('user')->limit($page, $limit)->select();
    }

    private function getArticle(int $page, int $limit)
    {
        $article = new Article();
        return $article->with('user')->limit($page, $limit)->select();
    }
}

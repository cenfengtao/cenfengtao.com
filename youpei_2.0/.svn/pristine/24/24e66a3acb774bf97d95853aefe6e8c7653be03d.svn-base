<?php
/**
 * 关键字处理
 * @author jxiao
 */
import("Vendor.Wechat.WeixinControllerModel");
use Common\Controller\Wechat;

class WeixinControllerKeyWordsModel extends WeixinControllerModel
{
    private function private_tree($tree)
    {
        $tree ['startdate'] = strtotime($tree ['startdate']);
        $tree ['enddate'] = strtotime($tree ['enddate']);
        $current = time();
        if ($current <= $tree ['startdate']) {
            return array(
                '活动还没有开始再等等吧！！',
                'text'
            );
        } else if ($current >= $tree ['enddate']) {
            return array(
                '活动已结束,下次再来吧！！',
                'text'
            );
        } else {
            return array(
                array(
                    array(
                        $tree ['title'],
                        $tree ['desc'],
                        $tree ['reply_image'],
                        rtrim(C('site_url'), '/') . U('Wap/PrivateTree/index', array(
                            'tree_id' => $tree ['id'],
                            'token' => $this->token,
                            'wecha_id' => $this->data ['FromUserName']
                        ))
                    )
                ),
                'news'
            );
        }
    }

    private function wall($wall)
    {
        return array(
            array(
                array(
                    $wall ['title'],
                    $wall ['description'],
                    $wall ['image'],
                    rtrim(C('site_url'), '/') . U('Wap/Wall/index', array(
                        'id' => $wall ['id'],
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName']
                    ))
                )
            ),
            'news'
        );
        //}
    }

    private function music($music)
    {
        if ($music ['status'] == 0) {
            return array(
                '活动还没有开始再等等吧！！',
                'text'
            );
        } else {
            $current = time();

            if ($current <= $music ['startdate']) {
                return array(
                    '活动还没有开始再等等吧！！',
                    'text'
                );
            } else if ($current >= $music ['enddate']) {
                return array(
                    '活动结束了,等待下次吧',
                    'text'
                );
            } else {
                return array(
                    array(
                        array(
                            $music ['title'],
                            $music ['description'],
                            $music ['picurl'],
                            rtrim(C('site_url'), '/') . U('Wap/Music/create', array(
                                'token' => $this->token,
                                'wecha_id' => $this->data ['FromUserName'],
                                'music_id' => $music ['id']
                            ))
                        )
                    ),
                    'news'
                );
            }
        }
    }

    private function tree($tree)
    {
        $tree ['startdate'] = strtotime($tree ['startdate']);
        $tree ['enddate'] = strtotime($tree ['enddate']);
        $current = time();
        if ($current <= $tree ['startdate']) {
            return array(
                '活动还没有开始再等等吧！！',
                'text'
            );
        } else if ($current >= $tree ['enddate']) {
            return array(
                array(
                    array(
                        $tree ['title'],
                        $tree ['desc'],
                        $tree ['reply_image'],
                        rtrim(C('site_url'), '/') . U('Wap/Tree/index', array(
                            'token' => $this->token,
                            'wecha_id' => $this->data ['FromUserName'],
                            'tree_id' => $tree ['id']
                        ))
                    )
                ),
                'news'
            );
        } else {
            return array(
                array(
                    array(
                        $tree ['title'],
                        $tree ['desc'],
                        $tree ['reply_image'],
                        rtrim(C('site_url'), '/') . U('Wap/Tree/index', array(
                            'token' => $this->token,
                            'wecha_id' => $this->data ['FromUserName'],
                            'tree_id' => $tree ['id']
                        ))
                    )
                ),
                'news'
            );
        }
    }

    private function question($question)
    {
        $current = time();
        if ($current <= $question ['startdate']) {
            return array(
                '活动还没有开始再等等吧！',
                'text'
            );
        } else if ($current >= $question ['enddate']) {
            return array(
                '活动已经结束,下次早点来吧！',
                'text'
            );
        } else {
            return array(
                array(
                    array(
                        $question ['title'],
                        $question ['desc'],
                        $question ['reply_image'],
                        rtrim(C('site_url'), '/') . U('Wap/Question/index', array(
                            'token' => $this->token,
                            'wecha_id' => $this->data ['FromUserName'],
                            'id' => $question['id']
                        ))
                    )
                ),
                'news'
            );
        }
    }

    function good($tree)
    {
        $tree ['startdate'] = strtotime($tree ['startdate']);
        $tree ['enddate'] = strtotime($tree ['enddate']);
        $current = time();
        if ($current <= $tree ['startdate']) {
            return array(
                '活动还没有开始再等等吧！！',
                'text'
            );
        } else if ($current >= $tree ['enddate']) {
            return array(
                array(
                    array(
                        $tree ['title'],
                        $tree ['desc'],
                        $tree ['reply_image'],
                        rtrim(C('site_url'), '/') . U('Wap/Good/index', array(
                            'token' => $this->token,
                            'wecha_id' => $this->data ['FromUserName'],
                            'tree_id' => $tree['id']
                        ))
                    )
                ),
                'news'
            );
        } else {
            return array(
                array(
                    array(
                        $tree ['title'],
                        $tree ['desc'],
                        $tree ['reply_image'],
                        rtrim(C('site_url'), '/') . U('Wap/Good/index', array(
                            'token' => $this->token,
                            'wecha_id' => $this->data ['FromUserName'],
                            'tree_id' => $tree['id']
                        ))
                    )
                ),
                'news'
            );
        }
    }

    private function replyRule($rule)
    {
        $model = new WeixinControllerReplyRuleModel ();
        $model->setToken($this->token);
        $model->setParams("keyWord", $this->params ['keyWord']);
        $model->setParams("rule", $rule);
        return $model->reply($this->data);
    }

    private function shake($shake, $keyword)
    {
        if ($shake['status'] == 0) {
            return array('活动已结束，请等待重新发起活动');
        }
        $title = $shake['event_name'];
        $desc = $shake['description'];
        $image = $shake['image'];
        $url = C('site_url') . U('Wap/Shake/index', array('token' => $this->token, 'wecha_id' => $this->data ['FromUserName'], 'id' => $shake['id']));
        return array(
            array(
                array(
                    $title,
                    $desc,
                    $image,
                    $url
                )
            ),
            'news'
        );
    }

    private function img($img)
    {
        $picUrl = $img['pic'];
        if ((strpos($picUrl, 'http') === FALSE) && (strpos($picUrl, 'https') === FALSE)) {
            $picUrl = 'http://' . $_SERVER['HTTP_HOST'] . $picUrl;
        }
        $return[] = [
            $img['title'],
            $img['desc'],
            $picUrl,
            $img['url'],
        ];
        return array(
            $return,
            'news'
        );
    }

    private function lottery($lottery, $keyword)
    {
        if ($lottery == false || $lottery ['status'] == 3) {
            return array(
                '活动可能已经结束或者被删除了',
                'text'
            );
        }
        switch ($lottery ['type']) {
            case 1 :
                $model = 'Lottery';
                break;
            case 2 :
                $model = 'Guajiang';
                break;
            case 3 :
                $model = 'Coupon';
        }
        $id = $lottery ['id'];
        $type = $lottery ['type'];
        if ($lottery ['status'] == 1) {
            $picurl = $lottery ['starpicurl'];
            $title = $lottery ['title'];
            $info = $lottery ['info'];
        } else {
            $picurl = $lottery ['endpicurl'];
            $title = $lottery ['endtite'];
            $info = $lottery ['endinfo'];
        }
        $url = C('site_url') . U('Wap/' . $model . '/index', array(
                'token' => $this->token,
                'type' => $type,
                'wecha_id' => $this->data ['FromUserName'],
                'id' => $id,
                'type' => $type
            ));
        return array(
            array(
                array(
                    $title,
                    $info,
                    $picurl,
                    $url
                )
            ),
            'news'
        );
    }

    private function vote($vote, $keyword)
    {
        return array(
            array(
                array(
                    $vote ['title'],
                    str_replace('&nbsp;', ' ', strip_tags(htmlspecialchars_decode($vote ['info']))),
                    $vote ['picurl'],
                    C('site_url') . U('Wap/Vote/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'id' => $vote ['id']
                    ))
                )
            ),
            'news'
        );
    }

    private function yiliao($yiliao, $keyword)
    {
        return array(
            array(
                array(
                    $yiliao ['title'],
                    strip_tags(htmlspecialchars_decode($yiliao ['info'])),
                    $yiliao ['topic'],
                    C('site_url') . U('Wap/Yiliao/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'id' => $yiliao ['id']
                    ))
                )
            ),
            'news'
        );
    }

    private function jiudian($jiudian, $keyword)
    {
        return array(
            array(
                array(
                    $jiudian ['title'],
                    strip_tags(htmlspecialchars_decode($jiudian ['info'])),
                    $jiudian ['topic'],
                    C('site_url') . U('Wap/Jiudian/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'id' => $jiudian ['id']
                    ))
                )
            ),
            'news'
        );
    }

    private function host($host, $keyword)
    {
        return array(
            array(
                array(
                    $host ['name'],
                    $host ['info'],
                    $host ['ppicurl'],
                    C('site_url') . U('Wap/Host/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'hid' => $host ['id']
                    ))
                )
            ),
            'news'
        );
    }

    private function product($product, $keyword)
    {
        return array(
            array(
                array(
                    $product ['name'],
                    strip_tags(htmlspecialchars_decode($product ['intro'])),
                    $product ['logourl'],
                    C('site_url') . U('Wap/Product/product', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'id' => $keyword ['pid']
                    ))
                )
            ),
            'news'
        );
    }

    private function form($form, $keyword)
    {
        return array(
            array(
                array(
                    $form ['name'],
                    strip_tags(htmlspecialchars_decode($form ['intro'])),
                    $form ['logourl'],
                    C('site_url') . U('Wap/Selfform/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'id' => $keyword ['pid']
                    ))
                )
            ),
            'news'
        );
    }

    private function sns($sns, $keyword)
    {
        return array(
            array(
                array(
                    $sns ['reply_title'],
                    strip_tags(htmlspecialchars_decode($sns ['reply_desc'])),
                    $sns ['reply_image'],
                    C('site_url') . U('Wap/Sns/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'group_id' => $sns ['id']
                    ))
                )
            ),
            'news'
        );
    }


    private function estate($estate, $keyword)
    {
        return array(
            array(
                array(
                    $estate ['title'],
                    $estate ['estate_desc'],
                    $estate ['cover'],

                    C('site_url') . U('Wap/Estate/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                    ))
                ),
                array(
                    '课程介绍',
                    $estate ['estate_desc'],
                    $estate ['house_banner'],
                    C('site_url') . U('Wap/Estate/index', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'hid' => $keyword['pid']
                    ))
                ),
                array(
                    '专家点评',
                    $estate ['estate_desc'],
                    $estate ['cover'],
                    C('site_url') . U('Wap/Estate/impress', array(
                        'token' => $this->token,
                        'wecha_id' => $this->data ['FromUserName'],
                        'hid' => $keyword['pid']
                    ))
                ),
            ),
            'news'
        );
    }

    public function _reply()
    {
        $key = $this->params['keyWord'];
        $this->isDone = true;
        $like['keyword'] = $key;
        $like['token'] = $this->token;
        $keyword = M('Keyword')->where($like)->order('id desc')->find();
        if ($keyword != false) {
            switch ($keyword ['type']) {
                case 'Img' : // 图文
                    $img_db = M($keyword ['type']);
                    $back = $img_db->where(array(
                        'keyword' => $key
                    ))->find();
                    return $this->img($back);
                case 'Text' : // 文本回复

                    $info = M($keyword ['type'])->order('id desc')->find($keyword ['type_id']);
                    return array(
                        htmlspecialchars_decode($info ['text']),
                        'text'
                    );
                default : // 默认
                    return array(
                        htmlspecialchars_decode('您好，留言请等待客服回复'),
                        'text'
                    );
            }
        } else {
            //默认回复
            $defaultReply = M('organization')->where("token='{$this->token}'")->getField('default_reply');
            if (!$defaultReply || empty($defaultReply)) {
                return array(
                    htmlspecialchars_decode('您好，留言请等待客服回复'),
                    'text',
                );
            }
            return array(
                htmlspecialchars_decode($defaultReply),
                'text',
            );
        }
    }
}

?>
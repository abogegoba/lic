<?php
/**
 * 業務エラーメッセージ
 */
return [
    /**
     * BusinessException継承クラス固定メッセージ
     */
    'duplication' => [
        'mail_address' => '既に登録済みのメールアドレスです。',
        'sending_to' => '既に登録済みのメールアドレスです。',
        'recruitment_work_location' => '他の勤務地を選択してください。',
    ],

    /**
     * ObjectNotFound
     */
    'object_not_found' => [
        'App\Domain\Entities\AdminAccount' => '対象の管理アカウントが存在しません',
        'App\Domain\Entities\UserAccount' => '対象のユーザーアカウントが存在しません',
    ],

    /**
     * AuthenticationFailed
     */
    'authentication_failed_admin' => 'ユーザーID又はパスワードが不正です。',
    'authentication_failed_front' => 'メールアドレス又はパスワードが不正です。',

    /**
     * カスタムメッセージ
     */
    "necessary_change_password" => "パスワードを変更してください。",
    'cant_store_graduation_period' => "卒業年月が登録出来ません。",

    'id_photo_over_size' => '照明写真の容量を小さくしてください。',
    'private_photo_over_size' => 'プライベート写真の容量を小さくしてください。',
    'id_photo_required_choice' => '照明写真を選択してください',
    'private_photo_required_choice' => 'プライベート写真を選択してください',
    'id_photo_choice_img' => '照明写真は.pngもしくは.jpg形式にしてください。',
    'private_photo_choice_img' => 'プライベート写真は.pngもしくは.jpg形式にしてください。',
    'pr_video1_over_size' => 'PR動画の容量を小さくしてください。',
    'pr_video1_choice_movie' => 'PR動画は.mp4形式にしてください。',
    'pr_video2_over_size' => 'PR動画の容量を小さくしてください。',
    'pr_video2_choice_movie' => 'PR動画は.mp4形式にしてください。',
    'pr_video3_over_size' => 'PR動画の容量を小さくしてください。',
    'pr_video3_choice_movie' => 'PR動画は.mp4形式にしてください。',
    'can_not_send_message' => '送信上限社数に達しています。翌月以降で再度お試しください。',
    'can_not_recruiting_create' => '求人数が最大のため登録出来ません。',
    'not_found_target_company' => '対象の企業が見つかりません。',
    'not_found_target_member' => '対象の会員が見つかりません。',
];

<?php

use App\Constants\ErrorCodes;

return [
    'default' => [
        'message' => 'Bir sorun oluştu. Lütfen tekrar deneyin!',
        'crud' => [
            'list' => 'Listeleme işlemi başarısız. Sistem yöneticinize başvurunuz!',
            'show' => 'Görüntüleme işlemi başarısız. Sistem yöneticinize başvurunuz!',
            'store' => 'Kayıt işlemi başarısız. Sistem yöneticinize başvurunuz!',
            'update' => 'Güncelleme işlemi başarısız. Sistem yöneticinize başvurunuz!',
            'delete' => 'Silme işlemi başarısız. Sistem yöneticinize başvurunuz!',
        ],
        'validation' => [
            'message' => 'İstek doğrulanırken hata oluştu. Lütfen tekrar deneyin!',
        ]
    ],
    'code' => [
        ErrorCodes::GENERAL_ERROR => 'Bir hata oluştu. Lütfen tekrar deneyin!',
        ErrorCodes::GENERAL_VALIDATION_ERROR => 'İstek doğrulanırken hata oluştu. Lütfen tekrar deneyin!',
        ErrorCodes::UNAUTHENTICATED => 'Yetkisiz erişim!',
        ErrorCodes::LOGIN_VALIDATION_ERROR => 'Hatalı parametreler gönderdiniz!',
        ErrorCodes::LOGIN_ATTEMPT_ERROR => 'Kullanıcı bilgileriniz hatalı. Sisteme giriş yapılamadı!',
        ErrorCodes::USER_LIST_ERROR => 'Kullanıcılar yüklenemedi!',
    ]
];

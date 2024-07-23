<?php

namespace Database\Seeders\Document;

use App\Models\DoctypeField;
use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentType::updateOrCreate(
            ['key' => 'zapyt_na_transport'],
            ['name' => 'Запит на транспорт',
                'settings' => '{
    "fields": {
        "header": {
            "1select_field_1": {
                "id": 1,
                "data": null,
                "hint": "Оберіть перевізника",
                "name": "Оператор",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "2select_field_2": {
                "id": 2,
                "data": null,
                "hint": "Оберіть замовника",
                "name": "Замовник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "3select_field_3": {
                "id": 3,
                "data": null,
                "hint": "Оберіть вантажовідправника",
                "name": "Вантажовідправник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "4select_field_4": {
                "id": 4,
                "data": null,
                "hint": "Оберіть вантажоотримувача",
                "name": "Вантажоотримувач",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "5select_field_5": {
                "id": 5,
                "data": null,
                "hint": "Оберіть контактну особу відправника",
                "name": "Контактна особа відправника",
                "type": "select",
                "required": false,
                "directory": "user"
            },
            "6select_field_6": {
                "id": 6,
                "data": null,
                "hint": "Оберіть контактну особу отримувача",
                "name": "Контактна особа отримувача",
                "type": "select",
                "required": false,
                "directory": "user"
            },
            "7select_field_7": {
                "id": 7,
                "data": null,
                "hint": "Оберіть локацію завантаження",
                "name": "Локація завантаження",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "8select_field_8": {
                "id": 8,
                "data": null,
                "hint": "Оберіть локацію розвантаження",
                "name": "Локація розвантаження",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [
        "Вимоги до транспорту",
        "Інформація про вантаж",
        "Відвантаження",
        "Розвантаження",
        "Умови доставки"
    ],
    "header_name": "Основна інформація",
    "custom_blocks": {
        "0": {
            "10text_field_10": {
                "id": 10,
                "hint": "Вкажіть висоту кузова",
                "name": "Висота кузова",
                "type": "text",
                "required": false
            },
            "9select_field_9": {
                "id": 9,
                "data": null,
                "hint": "Оберіть тип кузова",
                "name": "Тип кузова",
                "type": "select",
                "required": false,
                "directory": "transport_type"
            },
            "11range_field_11": {
                "id": 11,
                "hint": "",
                "name": "Температурний режим (С)",
                "type": "range",
                "required": false
            },
            "12switch_field_12": {
                "id": 12,
                "hint": "",
                "name": "Гідроборт",
                "type": "switch",
                "required": false
            }
        },
        "1": {
            "13text_field_13": {
                "id": 13,
                "hint": "Оберіть тип вантажу",
                "name": "Тип вантажу",
                "type": "text",
                "required": false
            },
            "14text_field_14": {
                "id": 14,
                "hint": "Вкажіть вагу брутто (кг)",
                "name": "Вага брутто (кг)",
                "type": "text",
                "required": false
            },
            "16text_field_16": {
                "id": 16,
                "hint": "Вкажіть к-сть місць (пал/м3)",
                "name": "К-сть місць (пал/м3)",
                "type": "text",
                "required": false
            },
            "17text_field_17": {
                "id": 17,
                "hint": "Вкажіть висоту палет",
                "name": "Висота палет",
                "type": "text",
                "required": false
            },
            "15select_field_15": {
                "id": 15,
                "data": null,
                "hint": "Оберіть тип пакування",
                "name": "Тип пакування",
                "type": "select",
                "required": false,
                "directory": "package_type"
            },
            "18switch_field_18": {
                "id": 18,
                "hint": "",
                "name": "Великогабаритний",
                "type": "switch",
                "required": false
            },
            "19switch_field_19": {
                "id": 19,
                "hint": "",
                "name": "Навантажені палети",
                "type": "switch",
                "required": false
            }
        },
        "2": {
            "20date_data_20": {
                "id": 20,
                "hint": "Вкажіть дату готовності",
                "name": "Дата готовності",
                "type": "date",
                "required": false
            },
            "22range_field_22": {
                "id": 22,
                "hint": "",
                "name": "Обід (при наявності)",
                "type": "range",
                "required": false
            },
            "21dateTimeRange_field_21": {
                "id": 21,
                "hint": "",
                "name": "Дата і години відвантаження",
                "type": "dateTimeRange",
                "required": false
            }
        },
        "3": {
            "23date_data_23": {
                "id": 23,
                "hint": "Вкажіть дату готовності",
                "name": "Дата готовності",
                "type": "date",
                "required": false
            },
            "25range_field_25": {
                "id": 25,
                "hint": "",
                "name": "Обід (при наявності)",
                "type": "range",
                "required": false
            },
            "24dateTimeRange_field_24": {
                "id": 24,
                "hint": "",
                "name": "Дата і години розвантаження",
                "type": "dateTimeRange",
                "required": false
            }
        },
        "4": {
            "26text_field_26": {
                "id": 26,
                "hint": "Вкажіть оціночну вартість вантажу",
                "name": "Оціночна вартість вантажу (грн з ПДВ)",
                "type": "text",
                "required": false
            },
            "27select_field_27": {
                "id": 27,
                "data": null,
                "hint": "Оберіть платника",
                "name": "Платник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "28switch_field_28": {
                "id": 28,
                "hint": "",
                "name": "Повернення піддонів",
                "type": "switch",
                "required": false
            },
            "29switch_field_29": {
                "id": 29,
                "hint": "",
                "name": "Повернення документів",
                "type": "switch",
                "required": false
            },
            "30comment_field_30": {
                "id": 30,
                "hint": "",
                "name": "Коментар по умовах",
                "type": "comment",
                "required": false
            }
        }
    },
    "document_kind": "",
    "document_type": []
}'
            ]);
        DocumentType::updateOrCreate(
            ['key' => 'zapyt_na_vantazh'],
            ['name' => 'Запит на вантаж',
                'settings' => '{
    "fields": {
        "header": {
            "1select_field_1": {
                "id": 1,
                "data": null,
                "hint": "Оберіть компанію",
                "name": "Компанія",
                "type": "select",
                "required": true,
                "directory": "company"
            },
            "2select_field_2": {
                "id": 2,
                "data": null,
                "hint": "Оберіть контактну особу",
                "name": "Контактна особа",
                "type": "select",
                "required": false,
                "directory": "user"
            },
            "3select_field_3": {
                "id": 3,
                "data": null,
                "hint": "Оберіть транспорт",
                "name": "Транспорт",
                "type": "select",
                "required": false,
                "directory": "transport"
            },
            "4select_field_4": {
                "id": 4,
                "data": null,
                "hint": "Оберіть додаткове обладнання",
                "name": "Додаткове обладнання",
                "type": "select",
                "required": false,
                "directory": "additional_equipment"
            },
            "5select_field_5": {
                "id": 5,
                "data": null,
                "hint": "Оберіть водія",
                "name": "Водій",
                "type": "select",
                "required": false,
                "directory": "driver"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [
        "\n                                                Інформація про маршрут\n                                            ",
        "\n                                                Інформація про вантаж\n                                            "
    ],
    "header_name": "Основна інформація",
    "custom_blocks": {
        "0": {
            "8text_field_8": {
                "id": 8,
                "hint": "Вкажіть максимальну к-сть точок завантаження",
                "name": "Максимальна к-сть точок завантаження",
                "type": "text",
                "required": false
            },
            "9text_field_9": {
                "id": 9,
                "hint": "Вкажіть максимальну к-сть точок розвантаження",
                "name": "Максимальна к-сть точок розвантаження",
                "type": "text",
                "required": false
            },
            "12text_field_12": {
                "id": 12,
                "hint": "",
                "name": "Відхилення від локації завантаження",
                "type": "text",
                "required": false
            },
            "13text_field_13": {
                "id": 13,
                "hint": "",
                "name": "Відхилення від локації розвантаження",
                "type": "text",
                "required": false
            },
            "6select_field_6": {
                "id": 6,
                "data": null,
                "hint": "Оберіть місто завантаження",
                "name": "Місто завантаження",
                "type": "select",
                "required": false,
                "directory": "settlement"
            },
            "7select_field_7": {
                "id": 7,
                "data": null,
                "hint": "Оберіть місто розвантаження",
                "name": "Місто розвантаження",
                "type": "select",
                "required": false,
                "directory": "settlement"
            },
            "10dateTimeRange_field_10": {
                "id": 10,
                "hint": "Вкажіть дату і час  завантаження",
                "name": "Дата і час  завантаження",
                "type": "dateTimeRange",
                "required": false
            },
            "11dateTimeRange_field_11": {
                "id": 11,
                "hint": "Вкажіть дату і час розвантаження",
                "name": "Дата і час розвантаження",
                "type": "dateTimeRange",
                "required": false
            }
        },
        "1": {
            "17text_field_17": {
                "id": 17,
                "hint": "Вкажіть місткість (пал)",
                "name": "Місткість (пал)",
                "type": "text",
                "required": false
            },
            "18text_field_18": {
                "id": 18,
                "hint": "Вкажіть максимальну вартість вантажу (грн)",
                "name": "Максимальна вартість вантажу (грн)",
                "type": "text",
                "required": false
            },
            "19text_field_19": {
                "id": 19,
                "hint": "Вкажіть вагу брутто (кг)",
                "name": "Вага брутто (кг)",
                "type": "text",
                "required": false
            },
            "20range_field_20": {
                "id": 20,
                "hint": "Вкажіть температурний режим (необов\'язково)",
                "name": "Температурний режим",
                "type": "range",
                "required": false
            },
            "16label_field_16": {
                "id": 16,
                "hint": "Вкажіть тип вантажу",
                "name": "Тип вантажу",
                "type": "label",
                "required": false,
                "directory": "cargo_type"
            },
            "22switch_field_22": {
                "id": 22,
                "hint": "",
                "name": "Страхування вантажу",
                "type": "switch",
                "required": false
            },
            "23switch_field_23": {
                "id": 23,
                "hint": "",
                "name": "Наявність гідроборту",
                "type": "switch",
                "required": false
            },
            "21comment_field_21": {
                "id": 21,
                "hint": "",
                "name": "Коментар по умовах",
                "type": "comment",
                "required": false
            }
        }
    },
    "document_kind": "4",
    "document_type": []
}'
            ]);

        DocumentType::updateOrCreate(
            ['key' => 'zaiavky_na_pryiom'],
            ['name' => 'Заявки на прийом',
                'settings' => '{
    "fields": {
        "header": {
            "8text_field_8": {
                "id": 8,
                "hint": "Введіть текст",
                "name": "Тип доставки",
                "type": "text",
                "required": false
            },
            "9date_field_9": {
                "id": 9,
                "hint": "",
                "name": "Планова дата поступлення",
                "type": "date",
                "required": false
            },
            "2range_field_2": {
                "id": 2,
                "hint": "",
                "name": "Діапазон",
                "type": "range",
                "required": false
            },
            "11text_field_11": {
                "id": 11,
                "hint": "Введіть текст",
                "name": "ДНЗ транспорту",
                "type": "text",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "Оберіть компанію замовникакокккокомп",
                "name": "Замовник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "3select_field_3": {
                "id": 3,
                "hint": "",
                "name": "Контактна особа замовника",
                "type": "select",
                "required": false,
                "directory": "user"
            },
            "4select_field_4": {
                "id": 4,
                "hint": "Оберіть компанію-отримувача",
                "name": "Отримувач",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "5select_field_5": {
                "id": 5,
                "hint": "Оберіть локацію розвантаження",
                "name": "Локація розвантаження",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "6switch_field_6": {
                "id": 6,
                "hint": "",
                "name": "Наявність пломби",
                "type": "switch",
                "required": false
            },
            "7select_field_7": {
                "id": 7,
                "hint": "Виберіть значення",
                "name": "Постачальник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "10range_field_10": {
                "id": 10,
                "hint": "",
                "name": "Час доставки",
                "type": "range",
                "required": false
            },
            "12comment_field_12": {
                "id": 12,
                "hint": "",
                "name": "Коментар по умовах",
                "type": "comment",
                "required": false
            }
        },
        "nomenclature": {
            "2date_field_2": {
                "id": 2,
                "hint": "",
                "name": "Партія",
                "type": "date",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "Виберіть значення",
                "name": "Тип пакування",
                "type": "select",
                "required": false,
                "directory": "package_type"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "",
    "block_names": [],
    "header_name": "Основна інформація",
    "custom_blocks": {},
    "document_type": []
}'
            ]);

        DocumentType::updateOrCreate(
            ['key' => 'zaiavka_na_vidvantazhennia'],
            ['name' => 'Заявка на відвантаження',
                'settings' => '{
    "fields": {
        "header": {
            "7text_field_7": {
                "id": 7,
                "hint": "",
                "name": "Тип доставки",
                "type": "text",
                "required": false
            },
            "8date_field_8": {
                "id": 8,
                "hint": "",
                "name": "Дата доставки",
                "type": "date",
                "required": false
            },
            "9range_field_9": {
                "id": 9,
                "hint": "",
                "name": "Час доставки",
                "type": "range",
                "required": false
            },
            "10text_field_10": {
                "id": 10,
                "hint": "",
                "name": "ДНЗ транспорту",
                "type": "text",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "Виберіть значення",
                "name": "Замовник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "2select_field_2": {
                "id": 2,
                "hint": "",
                "name": "Контактна особа замовника",
                "type": "select",
                "required": false,
                "directory": "user"
            },
            "3select_field_3": {
                "id": 3,
                "hint": "Виберіть значення",
                "name": "Отримувач",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "4select_field_4": {
                "id": 4,
                "hint": "Виберіть значення",
                "name": "Локація завантаження",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "5switch_field_5": {
                "id": 5,
                "hint": "",
                "name": "Наявність пломби",
                "type": "switch",
                "required": false
            },
            "6select_field_6": {
                "id": 6,
                "hint": "Виберіть значення",
                "name": "Постачальник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "11comment_field_11": {
                "id": 11,
                "hint": "",
                "name": "Коментар по умовах",
                "type": "comment",
                "required": false
            }
        },
        "nomenclature": {
            "2date_field_2": {
                "id": 2,
                "hint": "",
                "name": "Партія",
                "type": "date",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "Виберіть значення",
                "name": "Тип пакування",
                "type": "select",
                "required": false,
                "directory": "package_type"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [],
    "header_name": "Основна інформація",
    "custom_blocks": {},
    "document_type": []
}'
            ]);

        DocumentType::updateOrCreate(
            ['key' => 'ttn'],
            ['name' => 'ТТН',
                'settings' => '{
    "fields": {
        "header": {
            "3date_field_3": {
                "id": 3,
                "hint": "",
                "name": "Дата ТТН",
                "type": "date",
                "required": false
            },
            "8text_field_8": {
                "id": 8,
                "hint": "",
                "name": "Код оператора",
                "type": "text",
                "required": false
            },
            "9text_field_9": {
                "id": 9,
                "hint": "",
                "name": "Вартість рейсу",
                "type": "text",
                "required": false
            },
            "2label_field_2": {
                "id": 2,
                "hint": "",
                "name": "Номер ТТН",
                "type": "label",
                "required": false,
                "directory": ""
            },
            "10text_field_10": {
                "id": 10,
                "hint": "",
                "name": "Собівартість",
                "type": "text",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "",
                "name": "Підстава для ТТН",
                "type": "select",
                "required": false,
                "directory": "basis_for_ttn"
            },
            "4select_field_4": {
                "id": 4,
                "hint": "",
                "name": "Перевізник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "5select_field_5": {
                "id": 5,
                "hint": "",
                "name": "Транспорт",
                "type": "select",
                "required": false,
                "directory": "transport"
            },
            "6select_field_6": {
                "id": 6,
                "hint": "",
                "name": "Додаткове обладнання",
                "type": "select",
                "required": false,
                "directory": "additional_equipment"
            },
            "7select_field_7": {
                "id": 7,
                "hint": "",
                "name": "Водій",
                "type": "select",
                "required": false,
                "directory": "user"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [],
    "header_name": "Основна інформація",
    "custom_blocks": {},
    "document_type": []
}'
            ]);

        DocumentType::updateOrCreate(
            ['key' => 'zamovlennia'],
            ['name' => 'Замовлення',
                'settings' => '{
    "fields": {
        "header": {
            "5date_field_5": {
                "id": 5,
                "hint": "Дата завантаження",
                "name": "Дата завантаження",
                "type": "date",
                "required": false
            },
            "6date_field_6": {
                "id": 6,
                "hint": "Дата відвантаження",
                "name": "Дата відвантаження",
                "type": "date",
                "required": false
            },
            "9text_field_9": {
                "id": 9,
                "hint": "",
                "name": "За договором",
                "type": "text",
                "required": false
            },
            "7range_field_7": {
                "id": 7,
                "hint": "",
                "name": "Час завантаження",
                "type": "range",
                "required": false
            },
            "8range_field_8": {
                "id": 8,
                "hint": "",
                "name": "Час розвантаження",
                "type": "range",
                "required": false
            },
            "10date_field_10": {
                "id": 10,
                "hint": "Дата створення документу",
                "name": "Дата створення документу",
                "type": "date",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "Компанія постачальник",
                "name": "Компанія постачальник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "2select_field_2": {
                "id": 2,
                "hint": "Компанія отримувач",
                "name": "Компанія отримувач",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "3select_field_3": {
                "id": 3,
                "hint": "Склад постачальник (завантаження)",
                "name": "Склад постачальник (завантаження)",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "4select_field_4": {
                "id": 4,
                "hint": "Склад отримувач (розвантаження)",
                "name": "Склад отримувач (розвантаження)",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "11comment_field_11": {
                "id": 11,
                "hint": "",
                "name": "Коментар",
                "type": "comment",
                "required": false
            }
        },
        "nomenclature": {
            "1date_field_1": {
                "id": 1,
                "hint": "Виберіть дату",
                "name": "Партія",
                "type": "date",
                "required": false
            },
            "2text_field_2": {
                "id": 2,
                "hint": "",
                "name": "Ціна з ПДВ (грн)",
                "type": "text",
                "required": false
            },
            "3text_field_3": {
                "id": 3,
                "hint": "",
                "name": "Ціна без ПДВ (грн)",
                "type": "text",
                "required": false
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [],
    "header_name": "Шапка",
    "custom_blocks": {},
    "document_type": []
}']);

        DocumentType::updateOrCreate(
            ['key' => 'pryhid_vid_postachalnyka'],
            ['name' => 'Прихід від постачальника',
                'settings' => '{
    "fields": {
        "header": {
            "1date_field_1": {
                "id": 1,
                "hint": "Дата створення цього документу",
                "name": "Дата створення цього документу",
                "type": "date",
                "required": false
            },
            "2select_field_2": {
                "id": 2,
                "hint": "Товарна накладна",
                "name": "Товарна накладна",
                "type": "select",
                "required": false,
                "directory": "document_goods_invoice"
            },
            "3select_field_3": {
                "id": 3,
                "hint": "Компанія постачальник",
                "name": "Компанія постачальник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "4select_field_4": {
                "id": 4,
                "hint": "Валюта",
                "name": "Валюта",
                "type": "select",
                "required": false,
                "directory": "currencies"
            },
            "5select_field_5": {
                "id": 5,
                "hint": "Компанія отримувач",
                "name": "Компанія отримувач",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "6select_field_6": {
                "id": 6,
                "hint": "Склад отримувач",
                "name": "Склад отримувач",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "7select_field_7": {
                "id": 7,
                "hint": "Місце приймання",
                "name": "Місце приймання",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "8comment_field_8": {
                "id": 8,
                "hint": "",
                "name": "Коментар",
                "type": "comment",
                "required": false
            }
        },
        "nomenclature": {
            "1text_field_1": {
                "id": 1,
                "hint": "Ціна з ПДВ (грн)",
                "name": "Ціна з ПДВ (грн)",
                "type": "text",
                "required": false
            },
            "2text_field_2": {
                "id": 2,
                "hint": "Ціна без ПДВ (грн)",
                "name": "Ціна без ПДВ (грн)",
                "type": "text",
                "required": false
            },
            "5date_field_5": {
                "id": 5,
                "hint": "Партія",
                "name": "Партія",
                "type": "date",
                "required": false
            },
            "3select_field_3": {
                "id": 3,
                "hint": "Одиниці",
                "name": "Одиниці",
                "type": "select",
                "required": false,
                "directory": "measurement_unit"
            },
            "4select_field_4": {
                "id": 4,
                "hint": "Склад",
                "name": "Склад",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [],
    "header_name": "Шапка",
    "custom_blocks": {},
    "document_type": []
}'
            ]);

        DocumentType::updateOrCreate(
            ['key' => 'spysannya'],
            ['name' => 'Списання',
                'settings' => '{
    "fields": {
        "header": {
            "1date_field_1": {
                "id": 1,
                "hint": "Дата створення цього документу",
                "name": "Дата створення цього документу",
                "type": "date",
                "required": false
            },
            "2select_field_2": {
                "id": 2,
                "hint": "Склад відправник",
                "name": "Склад відправник",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "3comment_field_3": {
                "id": 3,
                "hint": "",
                "name": "Коментар",
                "type": "comment",
                "required": false
            }
        },
        "nomenclature": {
            "3date_field_3": {
                "id": 3,
                "hint": "Партія",
                "name": "Партія",
                "type": "date",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "Одиниці",
                "name": "Одиниці",
                "type": "select",
                "required": false,
                "directory": "measurement_unit"
            },
            "2select_field_2": {
                "id": 2,
                "hint": "Склад відправник",
                "name": "Склад відправник",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [],
    "header_name": "Шапка",
    "custom_blocks": {},
    "document_type": []
}'
            ]);

        DocumentType::updateOrCreate(
            ['key' => 'vnutrischnie_peremischchennya'],
            ['name' => 'Внутрішнє переміщення',
                'settings' => '{
    "fields": {
        "header": {
            "1date_field_1": {
                "id": 1,
                "hint": "Дата створення цього документу",
                "name": "Дата створення цього документу",
                "type": "date",
                "required": false
            },
            "2select_field_2": {
                "id": 2,
                "hint": "Склад відправник",
                "name": "Склад відправник",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "3select_field_3": {
                "id": 3,
                "hint": "Склад отримувач",
                "name": "Склад отримувач",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "4comment_field_4": {
                "id": 4,
                "hint": "",
                "name": "Коментар",
                "type": "comment",
                "required": false
            }
        },
        "nomenclature": {
            "6date_field_6": {
                "id": 6,
                "hint": "Партія",
                "name": "Партія",
                "type": "date",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "hint": "Одиниці",
                "name": "Одиниці",
                "type": "select",
                "required": false,
                "directory": "measurement_unit"
            },
            "2select_field_2": {
                "id": 2,
                "hint": "Замовлення",
                "name": "Замовлення",
                "type": "select",
                "required": false,
                "directory": "document_order"
            },
            "3select_field_3": {
                "id": 3,
                "hint": "Обладнання",
                "name": "Обладнання",
                "type": "select",
                "required": false,
                "directory": "additional_equipment"
            },
            "4select_field_4": {
                "id": 4,
                "hint": "Склад відправник",
                "name": "Склад відправник",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "5select_field_5": {
                "id": 5,
                "hint": "Склад отримувач",
                "name": "Склад отримувач",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": false
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "",
    "block_names": [],
    "header_name": "Шапка",
    "custom_blocks": {},
    "document_type": []
}'
            ]);
        DocumentType::updateOrCreate(
            ['key' => 'tovarna_nakladna'],
            ['name' => 'Товарна накладна',
                'settings' => '{
    "fields": {
        "header": {
            "8text_field_8": {
                "id": 8,
                "hint": "Оберіть договір",
                "name": "За договором",
                "type": "text",
                "required": false
            },
            "9date_field_9": {
                "id": 9,
                "hint": "Вкажіть дату створення",
                "name": "Дата створення",
                "type": "date",
                "required": false
            },
            "1select_field_1": {
                "id": 1,
                "data": null,
                "hint": "Оберіть компанію постачальника",
                "name": "Компанія постачальник",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "2select_field_2": {
                "id": 2,
                "data": null,
                "hint": "Оберіть компанію отримувача",
                "name": "Компанія отримувач",
                "type": "select",
                "required": false,
                "directory": "company"
            },
            "3select_field_3": {
                "id": 3,
                "data": null,
                "hint": "Оберіть склад постачальник (завантаження)",
                "name": "Склад постачальник (завантаження)",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "4select_field_4": {
                "id": 4,
                "data": null,
                "hint": "Оберіть склад отримувач (розвантаження)",
                "name": "Склад отримувач (розвантаження)",
                "type": "select",
                "required": false,
                "directory": "warehouse"
            },
            "7select_field_7": {
                "id": 7,
                "data": null,
                "hint": "Оберіть № замовлення (документу)",
                "name": "№ замовлення (документу)",
                "type": "select",
                "required": false,
                "directory": "document_order"
            },
            "10comment_field_10": {
                "id": 10,
                "hint": "",
                "name": "Коментар",
                "type": "comment",
                "required": false
            },
            "5dateTimeRange_field_5": {
                "id": 5,
                "hint": "",
                "name": "Дата і час завантаження",
                "type": "dateTimeRange",
                "required": false
            },
            "6dateTimeRange_field_6": {
                "id": 6,
                "hint": "",
                "name": "Дата і час розвантаження",
                "type": "dateTimeRange",
                "required": false
            }
        },
        "nomenclature": {
            "1text_field_1": {
                "id": 1,
                "hint": "Вкажіть кількість палет",
                "name": "Палет",
                "type": "text",
                "required": false
            },
            "2text_field_2": {
                "id": 2,
                "hint": "Вкажіть ціну без ПДВ (грн)",
                "name": "Ціна без ПДВ (грн)",
                "type": "text",
                "required": false
            },
            "3text_field_3": {
                "id": 3,
                "hint": "Вкажіть ціну з ПДВ (грн)",
                "name": "Ціна з ПДВ (грн)",
                "type": "text",
                "required": false
            },
            "4select_field_4": {
                "id": 4,
                "data": null,
                "hint": "Оберіть одиниці",
                "name": "Одиниці",
                "type": "select",
                "required": false,
                "directory": "measurement_unit"
            }
        }
    },
    "layout": 1,
    "actions": {
        "copy": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "edit": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        },
        "delete": {
            "admin": true,
            "driver": true,
            "manager": false,
            "storekeeper": true
        }
    },
    "print_form": "1",
    "block_names": [],
    "header_name": "Основна інформація",
    "custom_blocks": {},
    "document_kind": "",
    "document_type": []
}'
            ]);
    }
}

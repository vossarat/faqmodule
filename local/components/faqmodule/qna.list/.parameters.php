<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "GROUPS" => [
        "PADDING" => [
            "NAME" => "Отступы",
            "SORT" => 110,
        ],
    ],
    "PARAMETERS" => [
        "PADDING_TOP" => [
            "PARENT" => "PADDING",
            "NAME" => "Отступ сверху (px)",
            "TYPE" => "STRING",
            "DEFAULT" => "40",
        ],
        "PADDING_BOTTOM" => [
            "PARENT" => "PADDING",
            "NAME" => "Отступ снизу (px)",
            "TYPE" => "STRING",
            "DEFAULT" => "40",
        ],
    ],
];

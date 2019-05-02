<?php

return [
    "login" => [
        "meta_title" => "Login",
        "headline" => "Welcome back!",
        "footer-headline" => "Don't have an account? <a href=\":link_url\">:link_name</a> ",
        "meta_description" => "Awes.IO Platform Demo"
    ],
    "register" => [
        "meta_title" => "Create an Account",
        "meta_description" => "Awes.IO Platform Demo",
        "headline" => "Create Your Account",
        "footer-headline" => "Already have an account? <a href=\":link_url\">:link_name</a> "
    ],
    "dashboard" => [
        "h1" => "Dashboard",
        "meta_title" => "Overview",
        "meta_description" => "Check your dashboard with all important metrics and values."
    ],
    "leads" => [
        "h1" => "Leads",
        "meta_title" => "Leads",
        "meta_description" => "Leads captured by your app",
        "modal" => [
            "new_lead" => [
                "title" => "Add new lead",
                "send_btn" => "Add new lead",
                "name" => "Name",
                "email" => "Email",
                "phone" => "Phone number"
            ],
            "edit_lead" => [
                "title" => "Edit lead",
                "name" => "Name",
                "email" => "Email",
                "phone" => "Phone number"
            ]
        ],
        "table" => [
            "col" => [
                "name" => "Name",
                "email" => "Email",
                "phone" => "Phone",
                "created" => "Created",
                "premium" => "Premium",
                "status" => "Status",
                "sales" => "Sales"
            ],
            "options" => [
                "edit" => "Edit"
            ],
            "mobile" => [
                "email" => "Email",
                "phone" => "Phone",
                "created" => "Created",
                "premium" => "Premium",
                "status" => "Status",
                "sales" => "Sales",
                "created_at" => "Created",
                "lead_phone" => "Phone"
            ],
            "loader" => "Loading....."
        ],
        "filter" => [
            "sort_by" => "Sort by",
            "name" => "Lead name",
            "filter" => "Filter",
            "email" => "Email",
            "phone" => "Phone",
            "status" => "Status",
            "created_at" => "Created at",
            "sales" => "Sales"
        ],
        "notify" => [
            "store" => "New lead was successfully created",
            "update" => "Lead was successfully updated"
        ]
    ],
    "settings" => [
        "h1" => "Settings",
        "meta_title" => "Settings",
        "meta_description" => "You can set up your profile, update settings and change private account data.",
        "form" => [
            "user" => [
                "send_btn" => "Update",
                "email" => "Email",
                "name" => "Name",
                "company" => "Company",
                "website" => "Website",
                "phone" => "Phone"
            ]
        ],
        "change_photo" => "change photo",
        "modal" => [
            "password" => [
                "title" => "Change password",
                "send_btn" => "Save",
                "password_current" => "Current password",
                "password" => "Password",
                "password_confirmation" => "Confirm Password"
            ]
        ],
        "notify" => [
            "update" => "User data successfully updated",
            "password" => "Password successfully updated"
        ]
    ],
    "lead" => [
        "tab" => [
            "info" => "Information"
        ],
        "info" => [
            "name" => "Name",
            "edit" => "Edit",
            "email" => "Email",
            "phone" => "Phone"
        ]
    ],
    "sales" => [
        "table" => [
            "col" => [
                "total" => "Total",
                "created" => "Created",
                "lead_phone" => "Phone",
                "lead_name" => "Name"
            ]
        ]
    ],
    "reset_password" => [
        "meta_title" => "Reset password",
        "meta_description" => "Package Kit - Managing your web projects and packages",
        "headline_pre" => "Reset password",
        "headline_pre_subtitle" => "Enter your email address you used to register. Number of messages is limited.",
        "footer-headline" => "<a href=\":link_url\">:link_name</a> "
    ],
    "analytics" => [
        "h1" => "Analytics"
    ],
    "tour" => [
        "login" => [
            "step_1" => "Build interactive business apps easy and fast. This demo was created in less than a day."
        ],
        "dashboard" => [
            "step_1" => "Full-featured user interface is available out of box.",
            "step_2" => "As well as awesome dark mode. You can click on user avatar and switch UI theme later.",
            "step_3" => "Create any types of charts easily.",
            "step_4" => "With dynamic filtering, additional metrics and links.",
            "step_5" => "As well as powerful interactive tables."
        ],
        "leads" => [
            "step_1" => "Full-featured and easy customizable filters and sorting capabilities.",
            "step_2" => "Which are fully integrated with our table-builder component and pagination."
        ],
        "analytics" => [
            "step_1" => "You can filter information for both charts and tables.",
            "step_2" => "And customize their appearance and data representation."
        ]
    ],
    "alerts" => [
        "install_demo" => "You can always install this demo locally, via Docker or quick installer. <a href=\"https://github.com/awes-io/demo\" style=\"color:white;\">Install now</a>"
    ]
];

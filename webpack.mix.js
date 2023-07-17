const mix = require("laravel-mix");

mix
    .copy("node_modules/admin-lte/dist/img", "./public/images", false)
    .copy("node_modules/admin-lte/plugins/fontawesome-free/webfonts", "./public/webfonts", false)
    .styles(
        [
            process.env?.NODE_ENV === "production" ? "node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css" : "node_modules/admin-lte/plugins/fontawesome-free/css/all.css",
            process.env?.NODE_ENV === "production" ? "node_modules/admin-lte/dist/css/adminlte.min.css" : "node_modules/admin-lte/dist/css/adminlte.css",
            process.env?.NODE_ENV === "production" ? "node_modules/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css" : "node_modules/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.css",
            "resources/css/custom.css",
            "resources/css/google-font.css"
        ],
        "public/css/app.css"
    )
    .js(
        [
            "resources/js/app.js",
            process.env?.NODE_ENV === "production" ? "node_modules/admin-lte/dist/js/adminlte.min.js" : "node_modules/admin-lte/dist/js/adminlte.js",
        ],
        "public/js"
    );

import "./bootstrap";
import "./theme.bundle";
import "./vendor.bundle";
import "../css/app.css";
import "../css/libs.bundle.css";
import "../css/libs.bundle.css.map";
import "../css/theme.bundle.css";
import "../css/theme.bundle.css.map";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

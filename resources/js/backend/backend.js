import $ from 'jquery';
window.$ = window.jQuery = $;

import "./bootstrap";
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Moment from 'react-moment';
import 'moment-timezone';
Moment.globalLocale = 'id';
Moment.globalTimezone = 'Asia/Jakarta';
Moment.globalLocal = true;

// backend
import "./feather";
import "./dropdown";
import "./sidebar";
import "./topbar";
// import "./mobile-menu";

// components
import "./components/configurations/General";
import "./components/User";
import "./components/UserBasic";
import "./components/Role";
import "./components/Permission";

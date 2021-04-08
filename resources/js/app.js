/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

import 'react-app-polyfill/ie11';
import 'react-app-polyfill/stable';

require('./bootstrap');
require('./countdown');
require('./nav-collapse');
require('owl.carousel');

require('./form-elements/radios-and-checkboxes');

require('../../app/Modules/Analytics/Resources/Assets/js/app');
require('../../app/Modules/Webinar/Resources/Assets/js/app');
require('../../app/Modules/Registration/Resources/Assets/js/app');
require('../../app/Modules/SupportChat/Resources/Assets/js/app');
require('../../app/Modules/PollsAndQuizzes/Resources/Assets/js/components/App');
require('../../app/Modules/Wordclouds/Resources/Assets/js/components/App');
require('../../app/Modules/Questions/Resources/Assets/js/components/App');
require('../../app/Modules/Social/Resources/Assets/js/components/App');

require('../js/auth/password-creation');
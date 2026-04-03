/*
 * CMS Simple — RTL entry point (Arabic)
 */

// Styles (Bootstrap RTL + Icons + Custom theme)
import './styles/app-rtl.scss';

// Bootstrap JS
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Stimulus
import './stimulus_bootstrap.js';

// Landing page interactions (shared with LTR)
import './_interactions.js';
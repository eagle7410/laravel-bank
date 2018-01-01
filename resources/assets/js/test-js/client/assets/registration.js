import Vue from 'vue';
import {components} from '../../../const'
import api from './apis/client';

require('../../../extends');

// Registration components
for (let name in components)
    Vue.component(name, components[name]);

window.apis = api;

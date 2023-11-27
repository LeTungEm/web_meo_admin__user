import {actions} from './actions'
import {mutations} from './mutations'
import {getters} from './getters'

const state = {
    choicedPublish: ["nef ne",'14'],
};
const namespaced = true;
export const shopContext = {
    namespaced,
    state,
    actions,
    getters,
    mutations
};
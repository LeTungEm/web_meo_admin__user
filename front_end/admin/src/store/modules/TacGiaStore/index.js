import { getters } from "./getters";

const state = {
    status: true,
};
const namespaced = true;
export const TacGiaStore = {
    namespaced,
    state,
    getters,
};
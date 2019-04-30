import store from './store'

export default function (to, from, next) {

    if (store.getters.isUserAdmin || store.getters.isUserSuperAdmin){
        next()
    }else {
        next(false)
    }

}
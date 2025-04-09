// import {createStore} from "vuex";
// import * as actions from './actions'
// import * as mutations from './mutations'
// import state from './state'

// const store = createStore({
//   state: {
//     user: {
//       token: sessionStorage.getItem('TOKEN'),
//       data: {}
//     }
//   },
//   getters: {},
//   actions,
//   mutations,
// })

// export default store

import {createStore} from "vuex";
import state from './state'
import * as actions from './actions'
import * as mutations from './mutations'

const store = createStore({
  state,
  getters: {},
  actions,
  mutations,
})

export default store

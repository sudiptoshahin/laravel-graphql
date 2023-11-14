/** GraphQL dependency */
import { createApp, provide, h } from 'vue';
import { DefaultApolloClient } from '@vue/apollo-composable'
import { ApolloClient, InMemoryCache } from '@apollo/client/core'
/** GraphQL dependency ends */
import App from './App.vue'

/** router */
import router from "./routers";
/** router ends  */

/** GraphQL connection */
const cache = new InMemoryCache();
const apolloClient = new ApolloClient({
    cache,
    uri: "http://127.0.0.1:8000/graphql"
});
/** GraphQL connection ends */

const app = createApp({
    setup() {
        provide(DefaultApolloClient, apolloClient)
    },

    render: () => h(App),
});
app.use(router);
app.mount('#app');

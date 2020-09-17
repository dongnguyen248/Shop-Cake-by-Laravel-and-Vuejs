import Dashboard from "./components/Admin/dashboard.vue";
import User from "./components/Admin/User.vue";
import Product from "./components/Admin/Product.vue";
import ProductType from "./components/Admin/ProductType.vue";
import Category from "./components/Admin/Category.vue";

const routes = [
    { path: "/dashboar", comments: Dashboard },
    { path: "/user", comments: User },
    { path: "/product", component: Product },
    { path: "/productype", component: ProductType },
    { path: "/category", comments: Category }
];

export default routes;
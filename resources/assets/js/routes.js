import VueRouter from 'vue-router';


let routes=[
{
	path:'/',
	component:require('./components/Home')
},
{
	path:'/driver-profile',
	component:require('./components/DriverProfile')
},
{
	path:'/user-profile',
	component:require('./components/UserProfile')
},
{
	path:'/user-order',
	component:require('./components/UsersOrders')
},
{
	path:'/order-list',
	component:require('./components/DriverOrders')
},
{
	path:'*',
	component:require('./components/404')
},
{
	path:'/page-not-found',
	component:require('./components/404')
},
{
	path:'/server-error',
	component:require('./components/500')
}
];

export default new VueRouter({
	routes,
	linkActiveClass: 'active'
});
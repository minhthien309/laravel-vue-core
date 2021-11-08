<template>
	<!-- <a-layout id="components-layout-trigger"> -->
		<!-- <a-layout-sider v-model="collapsed" collapsible>
			<div class="logo" />
			<a-menu theme="dark" mode="horizontal" :default-selected-keys="['1']">
				<template v-for="menu in menus">
					<a-sub-menu v-if="menu.sub.length>0" :key="menu.path">
						<span slot="title"><a-icon :type="menu.icon" />{{!collapsed?menu.name:''}}</span>
						<a-menu-item v-for="sub in menu.sub" :key="sub.path">
							<router-link :to="'/'+sub.path">{{sub.name}}</router-link>
						</a-menu-item>
					</a-sub-menu>
					<a-menu-item v-else :key="menu.path">
						<router-link :to="'/'+menu.path"><a-icon :type="menu.icon" />{{!collapsed?menu.name:''}}</router-link>
					</a-menu-item>
				</template>
			</a-menu>
		</a-layout-sider> -->
		<a-layout>
			<a-layout-header style="background: #fff; padding: 0">
				<a-menu theme="light" mode="horizontal" :default-selected-keys="['1']">
					<template v-for="menu in menus">
						<a-sub-menu v-if="menu.sub.length>0" :key="menu.path">
							<span slot="title"><a-icon :type="menu.icon" />{{!collapsed?menu.name:''}}</span>
							<a-menu-item v-for="sub in menu.sub" :key="sub.path">
								<router-link :to="'/'+sub.path"><a-icon :type="sub.icon" />{{sub.name}}</router-link>
							</a-menu-item>
						</a-sub-menu>
						<a-menu-item v-else :key="menu.path">
							<router-link :to="'/'+menu.path"><a-icon :type="menu.icon" />{{!collapsed?menu.name:''}}</router-link>
						</a-menu-item>
					</template>
				</a-menu>
			</a-layout-header>
			<a-layout-content
				:style="{ margin: '24px 16px', padding: '24px', background: '#fff', minHeight: '280px' }"
			>
				<router-view />
			</a-layout-content>
		</a-layout>
	<!-- </a-layout> -->
</template>
<script>
export default {
	data() {
		return {
			collapsed: false,
			menus: [
				{
					name: 'Tổng quan',
					path: '',
					icon: 'home',
					sub: []
				},
				{
					name: 'Quản lý',
					path: 'file-manager',
					icon: 'solution',
					sub: [
						{
							name: 'Quản lý file',
							path: 'file-manager',
							icon: 'folder'
						}
					]
				},
			]
		};
	},
	mounted: function(){
		if(!this.$cookies.get("token")){
			this.$router.push({path: '/login'});
		}
	}
};
</script>
<style>
#components-layout-trigger .trigger {
	font-size: 18px;
	line-height: 64px;
	padding: 0 24px;
	cursor: pointer;
	transition: color 0.3s;
}

#components-layout-trigger .trigger:hover {
	color: #1890ff;
}

#components-layout-trigger .logo {
	height: 32px;
	background: rgba(255, 255, 255, 0.2);
	margin: 16px;
}

.ant-layout {
	height: 100vh;
}
</style>
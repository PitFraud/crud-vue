	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Vue-CRUD</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
		<style>
		#overlay{
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgb(0, 0, 0,0.6);
		}
		.container2 {
			height: 100vh;
			width: 100vw;
			font-family: Helvetica;
		}

		.loader {
			height: 20px;
			width: 250px;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
		}
		.loader--dot {
			animation-name: loader;
			animation-timing-function: ease-in-out;
			animation-duration: 3s;
			animation-iteration-count: infinite;
			height: 20px;
			width: 20px;
			border-radius: 100%;
			background-color: black;
			position: absolute;
			border: 2px solid white;
		}
		.loader--dot:first-child {
			background-color: #8cc759;
			animation-delay: 0.5s;
		}
		.loader--dot:nth-child(2) {
			background-color: #8c6daf;
			animation-delay: 0.4s;
		}
		.loader--dot:nth-child(3) {
			background-color: #ef5d74;
			animation-delay: 0.3s;
		}
		.loader--dot:nth-child(4) {
			background-color: #f9a74b;
			animation-delay: 0.2s;
		}
		.loader--dot:nth-child(5) {
			background-color: #60beeb;
			animation-delay: 0.1s;
		}
		.loader--dot:nth-child(6) {
			background-color: #fbef5a;
			animation-delay: 0s;
		}
		.loader--text {
			position: absolute;
			top: 200%;
			left: 0;
			right: 0;
			width: 4rem;
			margin: auto;
		}
		.loader--text:after {
			content: "Loading";
			font-weight: bold;
			animation-name: loading-text;
			animation-duration: 3s;
			animation-iteration-count: infinite;
		}

		@keyframes loader {
			15% {
				transform: translateX(0);
			}
			45% {
				transform: translateX(230px);
			}
			65% {
				transform: translateX(230px);
			}
			95% {
				transform: translateX(0);
			}
		}
		@keyframes loading-text {
			0% {
				content: "Loading";
			}
			25% {
				content: "Loading.";
			}
			50% {
				content: "Loading..";
			}
			75% {
				content: "Loading...";
			}
		}
	</style>
</head>
<body>
	<div id="app">
		<div class="conatiner-fluid p-1 bg-success text-white text-center">
			<h2>CRUD APPLICATION USING Vue.js, Codeigniter, MySql</h2>
			<small>This is my first Vue js project</small>
		</div>
		<div class="container">
			<hr class="bg-success">
			<div class="row">
				<div class="col-md-6"><h3 class="text-success">Registered Users</h3></div>
				<div class="col-md-6 text-end"><button class="btn btn-success"@click="showAddModal=true"><i class="fas fa-plus"></i> Add User</button></div>
			</div>
			<hr>
			<div class="alert alert-success" role="alert" v-if="alertSuccess">
				{{ alertSuccess }}
			</div>
			<div class="alert alert-danger" role="alert" v-if="alertDanger">
				{{ alertDanger }}
			</div>
			<table class="table table-bordered ">
				<thead class="table-success">
					<tr>
						<th scope="col" class="text-center">Sr.No</th>
						<th scope="col" class="text-center">User Name</th>
						<th scope="col" class="text-center">Email</th>
						<th scope="col" class="text-center">Phone</th>
						<th scope="col" class="text-center">Edit</th>
						<th scope="col" class="text-center">Delete</th> 
					</tr>
				</thead>
				<tbody>
					<tr v-for="user in users">
						<th scope="row" class="text-center">{{user.user_id}}</th>
						<td class="text-center">{{user.user_name}}</td>
						<td class="text-center">{{user.user_email}}</td>
						<td class="text-center">{{user.user_phone}}</td>
						<td class="text-center"><a href="#" @click="showEditModal=true" class="text-primary"><i class="far fa-edit"></i></a></td>
						<td class="text-center"><a href="#" @click="showDeleteModal=true" class="text-danger"><i class="far fa-trash-alt"></i></a></td>
					</tr>

				</tbody>
			</table>
		</div>
		<!-- Add New User Model -->
		<div id="overlay" v-if="showAddModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-success">Add New User</h5>
						<button type="button" class="close btn btn-outline-danger btn-sm" @click="showAddModal=false">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-4">
						<form action="#">
							<div class="form-group">
								<label for="name" class="form-label">User Name</label>
								<input type="text" class="form-control" id="u_name" name="u_name" placeholder="Enter User Name" v-model="newUser.u_name">
							</div>
							<div class="form-group">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" id="u_email" name="u_email" placeholder="Enter Email ID" v-model="newUser.u_email">
							</div>
							<div class="form-group">
								<label for="password" class="form-label">Phone</label>
								<input type="Text" class="form-control" id="u_phone" name="u_phone" placeholder="Enter Phone" v-model="newUser.u_phone">
							</div>
							<br>
							<div class="form-group">
								<button class="form-control btn btn-success btn-sm" @click="showAddModal=false; addUser();">Add User</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit New User Model -->
		<div id="overlay" v-if="showEditModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-success">Edit User</h5>
						<button type="button" class="close btn btn-outline-danger btn-sm" @click="showEditModal=false">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-4">
						<form action="#">
							<div class="form-group">
								<label for="name" class="form-label">User Name</label>
								<input type="hidden" name="u_id" value="">
								<input type="text" class="form-control" id="name" name="u_name" placeholder="Enter User Name">
							</div>
							<div class="form-group">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" id="email" name="u_name" placeholder="Enter Email ID">
							</div>
							<div class="form-group">
								<label for="password" class="form-label">Phone</label>
								<input type="text" class="form-control" id="Phone" name="u_phone" placeholder="Enter Phone">
							</div>
							<br>
							<div class="form-group">
								<button class="form-control btn btn-success btn-sm" @click="showEditModal=false">Update User</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit New User Model -->
		<div id="overlay" v-if="showDeleteModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-success">Delete User</h5>
						<button type="button" class="close btn btn-outline-danger btn-sm" @click="showDeleteModal=false">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-4">
						<h5 class="text-danger text-center">Are You Sure you want to delete this user?</h5>
						<h6 class="text-danger text-center">You are deleting 'Rajeev' user</h6>
						<hr>
						<button class="btn btn-danger">YES</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn btn-success" @click="showDeleteModal=false">NO</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Loader -->
		<div class='container2' id="overlay" v-if="showLoader">
			<div class='loader'>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--text'></div>
			</div>
		</div>

	</div>
	<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	
</body>
</html>
<script>
	
	var app = new Vue({ 
		el: '#app',
		data: {
			alertSuccess: '',
			alertDanger: '',
			showAddModal: false,
			showEditModal: false,
			showDeleteModal: false,
			showLoader: false,
			users:[],
			newUser: {u_name: "",u_email: "",u_phone: ""},
			currentUser: {}
		},
		mounted: function(){
			this.getAllUsers();

		},
		methods:{
			getAllUsers(){
				axios.get("http://127.0.0.1/crud_vue/getUser").then(function(response){
					
					if(response.data.error){
						app.alertDanger = response.data.message;
					}
					else{
						app.users = response.data.records;
					}
				});
			},

			addUser(){
				var FormData = app.toFormData(app.newUser);
				axios.post("http://127.0.0.1/crud_vue/addUser",FormData).then(function(response){
					app.newUser = {u_name: '',u_email: '',u_phone: ''};
					if(response.data.error){
						app.erroMsg = response.data.message;
					}
					else{
						app.alertSuccess = response.data.message;
						app.getAllUsers();
					}
				});
			},
			toFormData(obj){
				var fd = new FormData();
				for(var i in obj){
					fd.append(i,obj[i]);
				}
				return fd;
			},
		}
	});

</script>
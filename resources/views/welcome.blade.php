@extends('integratedAngular.mainAngular')

@section('content')
<script>
    var app = angular.module('myApp', []);
    app.controller('userController', function($scope, $http) {
        
    $scope.getUsers = function()
    {
        $http.get("list")
        .then(function(response) {            
            $scope.users = response.data;
        });
    }
    $scope.getUsers();
    
    $scope.saveData = function()
    {
        $http.post("save",$scope.form)
        .then(function(response) {
            $('#myModal').modal('hide');
            $scope.getUsers();
            $scope.form ={};
        });
    }
    
    $scope.delete = function(){      
       $http.get("delete/"+this.user.id)
        .then(function(response) {
             $scope.getUsers();
        });
    }
    
    $scope.edit = function(){   
       $http.get("edit/"+this.user.id)
        .then(function(response) {
             $('#myModal').modal('show');
             $scope.form = response.data;
        });
    }
});
</script>
<div ng-controller="userController" ng-app="myApp">
  <div class="container"><br><br>
   <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" style="margin-bottom:10px;">
  Create User
</button><br />
<table class="table table-bordered" >
    <thead>
      <tr>
        <th>Name</th>       
        <th>Email</th>
        <th>Action</th>
        
      </tr>
    </thead>
    <tbody>
        <tr ng-repeat="user in users">
            <td>
                @{{user.name}}
            </td>
            <td>
                @{{user.email}}
            </td>            
            <td>
                <a href="#" ng-click="edit()" class="glyphicon glyphicon-pencil"></a>
                <a href="#" ng-click="delete()" class="	glyphicon glyphicon-remove-circle"></a>
            </td>            
      </tr>
    </tbody>
  </table>  


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Enter Details</h4>
      </div>
      <div class="modal-body">
          <form ng-submit="saveData()">
             {{csrf_field()}}
            <div class="form-group">
              <label for="name">Name</label>
              <input type="name" class="form-control" ng-model="form.name" id="name" aria-describedby="name" placeholder="Enter name">              
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="email" ng-model="form.email" aria-describedby="emailHelp" placeholder="Enter email">
              
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" ng-model="form.password"  id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
       </form>
      </div>
      
    </div>
  </div>
</div>
</div>
</div>
@stop
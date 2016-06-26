var appLiveForm = angular.module('appLiveForm', []);

appLiveForm.controller('LiveForm_Ctrl', function($scope, $timeout) {
    
	/* Add Remove Tabs */
    $scope.lf_slides = [{id: 'ld_slide_0'}];
    $scope.addlfSlide = function() {
      	var newItemNo = $scope.lf_slides.length+1;
      	$scope.lf_slides.push({'id':'ld_slide_'+newItemNo});

    	$timeout(function() {
        	refreshtabs();
    	}, 10);

      	return $scope.lf_slides.length;
    };
    $scope.removelfSlide = function(item) {
    	console.log(item+'sd');
      $scope.lf_slides.splice(item,1);
    };  

});

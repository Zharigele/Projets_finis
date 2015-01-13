angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope,$ionicModal) {
  
				/* verification pour le mot chat */
				/* On vérifie si les cases vides contiennent les bonnes lettres */
				
				$scope.C_verif = function(){
				if ((angular.element(C_trou2).attr("x-lvl-drop-value")=='H')
				&& (angular.element(C_trou3).attr("x-lvl-drop-value")=='A')
				&& (angular.element(C_trou4).attr("x-lvl-drop-value")=='T'))
						{ alert("Bravo");
						}
						else
						{ alert("Oups c'est pas correct");
						}
					 
				
			      };
				  /* verification pour le mot pomme */
				$scope.P_verif = function(){
				if ((angular.element(P_trou2).attr("x-lvl-drop-value")=='O') 
				&& (angular.element(P_trou4).attr("x-lvl-drop-value")=='M'))
						{ alert("Bravo");
						}
						else
						{ alert("Oups c'est pas correct");
						}
					 
				
			      };/* verification pour le mot dragon */
				$scope.D_verif = function(){
				if ((angular.element(D_trou2).attr("x-lvl-drop-value")=='R')
				&& (angular.element(D_trou3).attr("x-lvl-drop-value")=='A')
				&& (angular.element(D_trou5).attr("x-lvl-drop-value")=='O'))
						{ alert("Bravo");
						}
						else
						{ alert("Oups c'est pas correct");
						}
					 
				
			      };/* verification pour le mot mammouth */
				$scope.M_verif = function(){
				if ((angular.element(M_trou3).attr("x-lvl-drop-value")=='M')
				&& (angular.element(M_trou4).attr("x-lvl-drop-value")=='M')
				&& (angular.element(M_trou5).attr("x-lvl-drop-value")=='O')
				&& (angular.element(M_trou7).attr("x-lvl-drop-value")=='T'))
						{ alert("Bravo");
						}
						else
						{ alert("Oups c'est pas correct");
						}
					 
				
			      };
				
				 
				
				 
					
  
  
  $scope.dropped = function(dragEl, dropEl) {
  
					//this is application logic, for the demo we just want to color the grid squares
					//the directive provides a native dom object, wrap with jqlite
					var drop = angular.element(dropEl);
					var drag = angular.element(dragEl);
					
				// on attribue la valeur de la case drag à la case drop
				
				drop.attr("x-lvl-drop-value", drag.attr("x-lvl-drag-value"));
				 	//clear the previously applied color, if it exists
					var bgClass = drop.attr('data-color');
					if (bgClass) {
						drop.removeClass(bgClass); 
						 
						 
					} 
					//add the dragged color
					bgClass = drag.attr("data-color");
					drop.addClass(bgClass);
					drop.attr('data-color', bgClass);

					//if element has been dragged from the grid, clear dragged color
					if (drag.attr("x-lvl-drop-target")) {
						drag.removeClass(bgClass);
						// si le glissement ce fait entre deux cases drop 
						drop.attr("x-lvl-drop-value", drag.attr("x-lvl-drop-value"));
						// on efface le contenu de la case drag
						drag.attr("x-lvl-drop-value","");
							 
					}
					 
					
				};
  
				// animation pour le pop-up (pour la fênetre qui fait apparaitre l'aide)
				$ionicModal.fromTemplateUrl('modal.html', {
					scope: $scope,
					animation: 'slide-in-up'
				  }).then(function(modal) {
					$scope.modal = modal;
				  });
				  
				  $scope.openModal = function() {
					$scope.modal.show();
				  };
				  $scope.closeModal = function() {
					$scope.modal.hide();
				  };
				  //Cleanup the modal when we're done with it!
				  $scope.$on('$destroy', function() {
					$scope.modal.remove();
				  });
				  
				});

 
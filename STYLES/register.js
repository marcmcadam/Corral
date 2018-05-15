$(document).ready(function(){
	
	$('form #stat').hide();
	$('#submit').click(function(e) {
		
		//e.preventDefault();
		
		var valid = '';
		var required = ' is required';
		var required2 = ' is required, must be 9 digit';
		var required3 = ' is required, at least 8 character';
		var sid = $('form #sid').val();

		var location = $('form #location').val();
		var employ = $('form #employ').val();
		var capstone = $('form #capstone').val();
		var course = $('form #course').val();
		
		var skill1 = $('form #skill1').val();
		var skill2 = $('form #skill2').val();
		var skill3 = $('form #skill3').val();
		var skill4 = $('form #skill4').val();
		var skill5 = $('form #skill5').val();
		var skill6 = $('form #skill6').val();
		var skill7 = $('form #skill7').val();
		var skill8 = $('form #skill8').val();
		var skill9 = $('form #skill9').val();
		var skill10 = $('form #skill10').val();
		var skill11 = $('form #skill11').val();
		var skill12 = $('form #skill12').val();
		var skill13 = $('form #skill13').val();
		var skill14 = $('form #skill14').val();
		
		var techsk1 = $('form #techsk1').val();
		var techsk2 = $('form #techsk2').val();
		var techsk3 = $('form #techsk3').val();
		var techskpro1 = $('form #techskpro1').val();
		var techskpro2 = $('form #techskpro2').val();
		var techskpro3 = $('form #techskpro3').val();	
			
		var softsk1 = $('form #softsk1').val();		
		var softsk2 = $('form #softsk2').val();
		var softsk3 = $('form #softsk3').val();
		var softskpro1 = $('form #techskpro3').val();
		var softskpro2 = $('form #techskpro3').val();
		var softskpro3 = $('form #techskpro3').val();
		
		var projti1 = $('form #projti1').val();
		var projti2 = $('form #projti1').val();
		var projti3 = $('form #projti1').val();
		var aspira = $('form #aspira').val();
		var profile = $('form #profile').val();
		var Entrepre = $('form #Entrepre').val();
		var permis = $('form #permis').val();
		var additi = $('form #additi').val();

		
		
// Student Details		
		

		
		if(sid1 = '' || !sid.match(/[0-9-()+]{9,10}/) || sid.length < 9 || sid.length > 9 ){
			valid += '<p>Invalid, your Student ID ' + required2 + '</p>';
			e.preventDefault();
		}

		
		
// Student Survey				
		
		if(location == ''){
			valid += '<p>Invalid, Q1 Student Location ' + required + '</p>';
			e.preventDefault();
		}
				
		if(employ == ''){
			valid += '<p>Invalid, Q2 Employment Status ' + required + '</p>';
			e.preventDefault();
		}
				if(capstone == ''){
			valid += '<p>Invalid, Q3 Capstone Enrolment ' + required + '</p>';
			e.preventDefault();
		}
				if(course == ''){
			valid += '<p>Invalid, Q4 Student Course ' + required + '</p>';
			e.preventDefault();
		}
				if(skill1 == ''){
			valid += '<p>Invalid, Q5 Programmer (General) ' + required + '</p>';
			e.preventDefault();
		}
		
				if(skill2 == ''){
			valid += '<p>Invalid, Q5 UX/UI Designer ' + required + '</p>';
			e.preventDefault();
		}
						if(skill3 == ''){
			valid += '<p>Invalid, Q5 Security Specialist ' + required + '</p>';
			e.preventDefault();
		}
						if(skill4 == ''){
			valid += '<p>Invalid, Q5 Database Developer ' + required + '</p>';
			e.preventDefault();
		}
						if(skill5 == ''){
			valid += '<p>Invalid, Q5 Web Developer ' + required + '</p>';
			e.preventDefault();
		}
						if(skill6 == ''){
			valid += '<p>Invalid, Q5 Cloud Service Developer ' + required + '</p>';
			e.preventDefault();
		}
						if(skill7 == ''){
			valid += '<p>Invalid, Q5 App Developer (Mobile) ' + required + '</p>';
			e.preventDefault();
		}
						if(skill8 == ''){
			valid += '<p>Invalid, Q5 Network Engineer ' + required + '</p>';
			e.preventDefault();
		}
						if(skill9 == ''){
			valid += '<p>Invalid, Q5 VR/Game Developer (Programming) ' + required + '</p>';
			e.preventDefault();
		}
						if(skill10 == ''){
			valid += '<p>Invalid, Q5 3D Artist/Animator ' + required + '</p>';
			e.preventDefault();
		}
						if(skill1 == ''){
			valid += '<p>Invalid, Q5 Technical Artist ' + required + '</p>';
			e.preventDefault();
		}
						if(skill2 == ''){
			valid += '<p>Invalid, Q5 Project Manager (Require technical skill) ' + required + '</p>';
			e.preventDefault();
		}
						if(skill3 == ''){
			valid += '<p>Invalid, Q5 Interactive Media Developer ' + required + '</p>';
			e.preventDefault();
		}
						if(skill4 == ''){
			valid += '<p>Invalid, Q5 Business Analyst ' + required + '</p>';
			e.preventDefault();
		}		
		
		
		
				if(techsk1 == ''){
			valid += '<p>Invalid, Q6 Tech Skill 1 ' + required + '</p>';
			e.preventDefault();
		}

						if(techsk1 == ''){
			valid += '<p>Invalid, Q6 Tech Skill 2 ' + required + '</p>';
			e.preventDefault();
		}
		
								if(techsk1 == ''){
			valid += '<p>Invalid, Q6 Tech Skill 3 ' + required + '</p>';
			e.preventDefault();
		}
		

						
				if(techskpro1 == ''){
			valid += '<p>Invalid, Q7 Technical Skill Proficiency 1 ' + required + '</p>';
			e.preventDefault();
		}
		
				if(techskpro1 == ''){
			valid += '<p>Invalid, Q7 Technical Skill Proficiency 2 ' + required + '</p>';
			e.preventDefault();
		}	
		
				if(techskpro1 == ''){
			valid += '<p>Invalid, Q7 Technical Skill Proficiency 3 ' + required + '</p>';
			e.preventDefault();
		}			
		
				if(softsk1 == ''){
			valid += '<p>Invalid, Q8 Soft Skill 1 ' + required + '</p>';
			e.preventDefault();
		}
		
						if(softsk2 == ''){
			valid += '<p>Invalid, Q8 Soft Skill 2 ' + required + '</p>';
			e.preventDefault();
		}
		
						if(softsk3 == ''){
			valid += '<p>Invalid, Q8 Soft Skill 3 ' + required + '</p>';
			e.preventDefault();
		}
		
		
				if(softskpro1 == ''){
			valid += '<p>Invalid, Q9 Soft Skill Proficiency 1 ' + required + '</p>';
			e.preventDefault();
		}
		
						if(softskpro2 == ''){
			valid += '<p>Invalid, Q9 Soft Skill Proficiency 2 ' + required + '</p>';
			e.preventDefault();
		}
		
		
						if(softskpro3 == ''){
			valid += '<p>Invalid, Q9 Soft Skill Proficiency 3 ' + required + '</p>';
			e.preventDefault();
		}
		
		
				if(projti1 == '' ){
			valid += '<p>Invalid, Q10 At Least One Project Title ' + required + '</p>';
			e.preventDefault();
		}

				if(projti2 == '' ){
			valid += '<p>Invalid, Q10 At Least One Project Title ' + required + '</p>';
			e.preventDefault();
		}

				if(projti3 == '' ){
			valid += '<p>Invalid, Q10 At Least One Project Title ' + required + '</p>';
			e.preventDefault();
		}				
				if(aspira == ''){
			valid += '<p>Invalid, Q11 Aspiration ' + required + '</p>';
			e.preventDefault();
		}
				if(profile == ''){
			valid += '<p>Invalid, Q12 Profile Profile ' + required + '</p>';
			e.preventDefault();
		}
				if(Entrepre == ''){
			valid += '<p>Invalid, Q13 Entrepreneurship ' + required + '</p>';
			e.preventDefault();
		}
				if(permis == ''){
			valid += '<p>Invalid, Q14 Permission to use Survey Data ' + required + '</p>';
			e.preventDefault();
		}
		
				if(additi == ''){
			valid += '<p>Invalid, Q15 Comment about the survey ' + required + '</p>';
			e.preventDefault();
		}		
		
//	
		
		if (valid != '') {
			
			$('form #stat').removeClass().addClass('error')
				
				.html('<strong>Warning!</strong> <p>&nbsp;</p>' +  valid ).fadeIn('slow');
				
							
		}else {
			$('form #stat').removeClass().addClass('error')
				
				.html('').fadeIn('slow');
													
			$('#submit').unbind('submit').submit()

		}
	});
});
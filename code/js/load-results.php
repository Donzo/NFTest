<script>
	function setResultData(){
		//Set Title
		setInnerHTML("title-of-test-div", "<h2 class='title-txt'>" + testName + "</h2>");
		//Set Image
		document.getElementById("nft-img-results-page").src=NFTimg;
		//Set Stats
		setInnerHTML("qsRight", "Right Answers: " + answersRight);
		setInnerHTML("qsWrong", "Wrong Answers: " + answersWrong);
		setInnerHTML("cap", "Average Correct: " + cap + "%");
		setInnerHTML("my-results-link", "<a href='" + pathToMyResults + "'>View JSON</a>");
	}
	setResultData();	
</script>

			<div id="multi-nft-div">
				<!-- Second NFT Div -->
				<div class="content-section multiNFTDiv" id="nft2Div">
					<div id='nftMakerHeaderTxt' class='cu-header-txt'>Upload Your Second NFT Image</div>
					<div id='nftMakerDirections' class='cu-dir1'>
						Choose ANOTHER IMAGE TO AWARD to those who <span style='text-decoration:underline'>score LOWER THAN the FIRST group</span>. You can CHANGE BOTH values still. 
					</div>
					<div id='imgUploader2' class='uploader'>
						<input type='file'  accept='image/gif, image/jpeg, image/png, image/svg' name='file2' class='fileSelector' id='file2' onchange='loadFile(event, 2)' style='display: none'>
					</div>
					<label for='file2'>
					<div class='button' id='imgUploadButton2'>Upload Image</div>
					</label>
					<div class='button disabledButton' id='imgRemoveButton2' onClick='removeImage(2)'>Remove Image</div>
					<div id='imgOutput2' class='imgOutputer'><img id='output2' /></div>
					<div class='delete-nft-button-div'>
						<div class='button redButton' id='deleteNFT2' onClick='deleteNFT(2)'>
							Delete NFT 2
						</div>
					</div>	
				</div>
				
				<div class="content-section" id="nftThresholdSetter2">
					<div id="nftMakerHeaderTxt" class="cu-header-txt">Minting Threshold 2</div>
					<div id="nftMakerDirections" class="cu-dir1">
						What is the percentage that users must score EQUAL OR GREATER THAN to mint NFT 2?
					</div>
					<div id='nftmnthrshControlsDiv2' class='threshold-setter-div'>
						<div class='thresholdSetterDiv'>
							<div class='thresholdSetterDir'>
							<label class='thresholdSetterLabel' for='thresholdSetter2'>
							Test Taker Must Score Less than <span id='nft2-max-score' class='value-pop'></span> and <span style='text-decoration: underline;'>EQUAL OR GREATER</span> Than This Percentage to Mint NFT 2: 
							</label>
							</div>
							<div class='thresholdSetterInputFieldDiv'>
								<div class='input-field-with-directions'>
									<div class='tiny-directions'>
										Don't Set Over <span id='nft2-max-scoreB'></span>
									</div>
									<input type='text' maxlength='2' id='thresholdSetter2' class='thresholdSetterInputField' onchange='verifyMultiValues()'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Third NFT Div -->
				<div class="content-section multiNFTDiv" id="nft3Div">
					<div id='nftMakerHeaderTxt' class='cu-header-txt'>Upload Your Third NFT Image</div>
					<div id='nftMakerDirections' class='cu-dir1'>
						Choose a THIRD IMAGE TO AWARD to those who <span style='text-decoration:underline'> score LOWER THAN the FIRST AND SECOND group</span>.
					</div>
					<div id='imgUploader3' class='uploader'>
						<input type='file'  accept='image/gif, image/jpeg, image/png, image/svg' name='file3' class='fileSelector' id='file3' onchange='loadFile(event, 3)' style='display: none'>
					</div>
					<label for='file3'>
					<div class='button' id='imgUploadButton3'>Upload Image</div>
					</label>
					<div class='button disabledButton' id='imgRemoveButton3' onClick='removeImage(3)'>Remove Image</div>
					<div id='imgOutput3' class='imgOutputer'><img id='output3' /></div>
					<div class='delete-nft-button-div'>
						<div class='button redButton' id='deleteNFT3' onClick='deleteNFT(3)'>
							Delete NFT 3
						</div>
					</div>	
									
				</div>
				
				<div class="content-section" id="nftThresholdSetter3">
					<div id="nftMakerHeaderTxt" class="cu-header-txt">Minting Threshold 3</div>
					<div id="nftMakerDirections" class="cu-dir1">
						What is the percentage that users must score EQUAL OR GREATER THAN to mint NFT 3?
					</div>
					<div id='nftmnthrshControlsDiv3' class='threshold-setter-div'>
						<div class='thresholdSetterDiv'>
							<div class='thresholdSetterDir'>
							<label class='thresholdSetterLabel' for='thresholdSetter3'>
							Test Taker Must Score Less than <span id='nft3-max-score' class='value-pop'></span> and <span style='text-decoration: underline;'>EQUAL OR GREATER</span> Than This Percentage to Mint NFT 3: 
							</label>
							</div>
							<div class='thresholdSetterInputFieldDiv'>
								<div class='input-field-with-directions'>
									<div class='tiny-directions'>
										Don't Set Over <span id='nft3-max-scoreB'></span>
									</div>
									<input type='text' maxlength='2' id='thresholdSetter3' class='thresholdSetterInputField' onchange='verifyMultiValues()'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Fourth NFT Div -->
				<div class="content-section multiNFTDiv" id="nft4Div">
					<div id='nftMakerHeaderTxt' class='cu-header-txt'>Upload Your Fourth NFT Image</div>
					<div id='nftMakerDirections' class='cu-dir1'>
						Choose a fourth image that you can award to people who complete your test <span style='text-decoration:underline'>but score LOWER THAN THE FIRST, SECOND, AND THIRD group</span> (you can still change these values). You can also keep adding more images.
					</div>
					<div id='imgUploader4' class='uploader'>
						<input type='file'  accept='image/gif, image/jpeg, image/png, image/svg' name='file4' class='fileSelector' id='file4' onchange='loadFile(event, 4)' style='display: none'>
					</div>
					<label for='file4'>
					<div class='button' id='imgUploadButton4'>Upload Image</div>
					</label>
					<div class='button disabledButton' id='imgRemoveButton4' onClick='removeImage(4)'>Remove Image</div>
					<div id='imgOutput4' class='imgOutputer'><img id='output4' /></div>
					<div class='delete-nft-button-div'>
						<div class='button redButton' id='deleteNFT4' onClick='deleteNFT(4)'>
							Delete NFT 4
						</div>
					</div>	
				</div>
				
				<div class="content-section" id="nftThresholdSetter4">
					<div id="nftMakerHeaderTxt" class="cu-header-txt">Minting Threshold 4</div>
					<div id="nftMakerDirections" class="cu-dir1">
						What is the percentage that users must score EQUAL OR GREATER THAN to mint NFT 4?
					</div>
					<div id='nftmnthrshControlsDiv4' class='threshold-setter-div'>
						<div class='thresholdSetterDiv'>
							<div class='thresholdSetterDir'>
							<label class='thresholdSetterLabel' for='thresholdSetter4'>
							Test Taker Must Score Less than <span id='nft4-max-score' class='value-pop'></span> and <span style='text-decoration: underline;'>EQUAL OR GREATER</span> Than This Percentage to Mint NFT 4: 
							</label>
							</div>
							<div class='thresholdSetterInputFieldDiv'>
								<div class='input-field-with-directions'>
									<div class='tiny-directions'>
										Don't Set Over <span id='nft4-max-scoreB'></span>
									</div>
									<input type='text' maxlength='2' id='thresholdSetter4' class='thresholdSetterInputField' onchange='verifyMultiValues()'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Fifth NFT Div -->
				<div class="content-section multiNFTDiv" id="nft5Div">
					<div id='nftMakerHeaderTxt' class='cu-header-txt'>Upload Your Fifth and Final NFT Image</div>
					<div id='nftMakerDirections' class='cu-dir1'>
						Choose a fifth and final image that you can award to people who complete your test <span style='text-decoration:underline'>but score LOWER THAN ALL OTHER groups</span> (you can still change these values). You MAY NOT ADD ANYMORE at this time.
					</div>
					<div id='imgUploader5' class='uploader'>
						<input type='file'  accept='image/gif, image/jpeg, image/png, image/svg' name='file5' class='fileSelector' id='file5' onchange='loadFile(event, 5)' style='display: none'>
					</div>
					<label for='file5'>
					<div class='button' id='imgUploadButton5'>Upload Image</div>
					</label>
					<div class='button disabledButton' id='imgRemoveButton5' onClick='removeImage(5)'>Remove Image</div>
					<div id='imgOutput5' class='imgOutputer'><img id='output5' /></div>	
					<div class='delete-nft-button-div'>
						<div class='button redButton' id='deleteNFT5' onClick='deleteNFT(5)'>
							Delete NFT 5
						</div>
					</div>	
				</div>
				
				<div class="content-section" id="nftThresholdSetter5">
					<div id="nftMakerHeaderTxt" class="cu-header-txt">Minting Threshold 5</div>
					<div id="nftMakerDirections" class="cu-dir1">
						What is the percentage that users must score EQUAL OR GREATER THAN to mint NFT 5?
					</div>
					<div id='nftmnthrshControlsDiv5' class='threshold-setter-div'>
						<div class='thresholdSetterDiv'>
							<div class='thresholdSetterDir'>
							<label class='thresholdSetterLabel' for='thresholdSetter5'>
							Test Taker Must Score Less than <span id='nft5-max-score' class='value-pop'></span> and <span style='text-decoration: underline;'>EQUAL OR GREATER</span> Than This Percentage to Mint NFT 5: 
							</label>
							</div>
							<div class='thresholdSetterInputFieldDiv'>
								<div class='input-field-with-directions'>
									<div class='tiny-directions'>
										Don't Set Over <span id='nft5-max-scoreB'></span>
									</div>
									<input type='text' maxlength='2' id='thresholdSetter5' class='thresholdSetterInputField' onchange='verifyMultiValues()'>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
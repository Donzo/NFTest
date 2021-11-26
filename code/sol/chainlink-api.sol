// SPDX-License-Identifier: MIT
pragma solidity ^0.8.7;

import "@chainlink/contracts/src/v0.8/ChainlinkClient.sol";

contract APIConsumer is ChainlinkClient {
    using Chainlink for Chainlink.Request;
  
    bool public pass;
    
    address private oracle;
    bytes32 private jobId;
    uint256 private fee;
    
    string public myRequest = "https://nftest.net/pass-api/?uAN=0xab8e6493def98177af1db49280a0d174b3ace9be&tID=18&pp=90";

    function setNewRequest(string memory _myRequest) public {
        myRequest = _myRequest;
    }

    constructor() {
        setPublicChainlinkToken();
        oracle = 0xc57B33452b4F7BB189bB5AfaE9cc4aBa1f7a4FD8;
        jobId = "bc746611ebee40a3989bbe49e12a02b9";
        fee = 0.1 * 10 ** 18; // (Varies by network and job)
    }
    
    function requestResult() public returns (bytes32 requestId) 
    {
        Chainlink.Request memory request = buildChainlinkRequest(jobId, address(this), this.fulfill.selector);
        
        // Set the URL to perform the GET request on
        request.add("get", myRequest);
        request.add("path", "pass");
        
        // Sends the request
        return sendChainlinkRequestTo(oracle, request, fee);
    }
    
    /**
     * Receive the response in the form of bool
     */ 
    function fulfill(bytes32 _requestId, bool _pass) public recordChainlinkFulfillment(_requestId) {
        pass = _pass;
    }
}

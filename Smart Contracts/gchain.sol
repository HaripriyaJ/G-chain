pragma solidity >=0.4.21 <0.7.0; //0.4.26
import "https://github.com/Arachnid/solidity-stringutils/blob/master/src/strings.sol";
contract DataContract {

    using strings for *;
    string s1;
    string s2;
    string s3;
    string s4;
    string s5;
    string s6;
    string s7;
    string s8;
    string s9;
    string s10;
    string s11;
    string last;
    string remove = "XX";

    // name,panno,aadharno,addr,bankaccno,ifsc,bank_details,startTime,endProcess 406733368038 BJQPP5524G
    struct UserInfo {
        string name;
        string uid;
        string panno;
        string aadharno;
        string addr;
        string ifsc;
        string bank_details;
        string designation;
    }
    mapping (string => UserInfo) AllUsers;
    
    
    struct Results{
        string result;
        uint256 startTime;
        uint256 endProcess;
    }
    
    mapping(string => Results) returnResult;
    
    function SetUserInfo(string memory _uid, string memory _Name, string memory _panno, string _aadharno, 
        string memory _addr, string memory _ifsc, string memory _bankDetails, string memory _designation, 
        uint256 _startTime, uint256 _endProcess )
    public {
        AllUsers[_uid].name = _Name;
        AllUsers[_uid].panno = _panno;
        AllUsers[_uid].aadharno = _aadharno;
        AllUsers[_uid].addr = _addr;
        AllUsers[_uid].ifsc = _ifsc;
        AllUsers[_uid].bank_details = _bankDetails;
        AllUsers[_uid].designation = _designation;


        s1 = (_uid.toSlice()).concat(remove.toSlice());
        s2 = s1.toSlice().concat((AllUsers[_uid].name).toSlice());
        s3 = s2.toSlice().concat(remove.toSlice());
        s4 = s3.toSlice().concat((AllUsers[_uid].panno).toSlice());
        s5 = s4.toSlice().concat(remove.toSlice());
        s6 = s5.toSlice().concat((AllUsers[_uid].aadharno).toSlice());
        s7 = s6.toSlice().concat(remove.toSlice());
        s8 = s7.toSlice().concat((AllUsers[_uid].addr).toSlice());
        s9 = s8.toSlice().concat(remove.toSlice());
        s10 = s9.toSlice().concat((AllUsers[_uid].ifsc).toSlice());
        s11 = s10.toSlice().concat(remove.toSlice());

        last = s11.toSlice().concat((AllUsers[_uid].bank_details).toSlice());

        returnResult[_uid].result = last;
        returnResult[_uid].startTime= _startTime;
        returnResult[_uid].endProcess = _endProcess;

    }
  
    function GetUserInfo(string memory _uid) 
    public view returns (string memory,string memory, uint256, uint256) 
    {
        return (returnResult[_uid].result,AllUsers[_uid].designation,returnResult[_uid].startTime, returnResult[_uid].endProcess);
    }   
}
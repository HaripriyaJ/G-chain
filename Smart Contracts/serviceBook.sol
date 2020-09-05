pragma solidity >=0.4.21 <0.7.0;

contract Service{
    struct details{
        string name;
        string designation;
        string dob;
        string emp_address;
        string email;
    }

    mapping(uint256=>details) retiringEmployee;
    
    
    function setEmployeeDetails(uint256 _aadhar, string memory _name, string memory _designation, string memory _dob,
                                string memory _empAddr, string memory _email) 
    public {
       retiringEmployee[_aadhar].name = _name;
       retiringEmployee[_aadhar].designation = _designation;
       retiringEmployee[_aadhar].dob = _dob;
       retiringEmployee[_aadhar].emp_address = _empAddr;
       retiringEmployee[_aadhar].email = _email;
    }
    
    
    function getEmployeeDetails(uint256 _aadhar) public view returns (uint256,string memory, string memory, string memory, string memory, string memory){
        return (_aadhar,retiringEmployee[_aadhar].name, retiringEmployee[_aadhar].designation,retiringEmployee[_aadhar].dob,
                retiringEmployee[_aadhar].emp_address, retiringEmployee[_aadhar].email);
    }
}

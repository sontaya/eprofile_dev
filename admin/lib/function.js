function thaiNumber(num){
 var array = {"1":"๑", "2":"๒", "3":"๓", "4" : "๔", "5" : "๕", "6" : "๖", "7" : "๗", "8" : "๘", "9" : "๙", "0" : "๐"};
 var str = num.toString();
 for (var val in array) {
  str = str.split(val).join(array[val]);
 }
 return str;
}
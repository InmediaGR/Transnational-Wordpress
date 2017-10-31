# Transnational-Wordpress

A wordpress plugin for interfacing with Transnational's 3 step transaction process.

# How to Use

This plugin creates two ajax actions for steps 1 and 3 to post to. 

#### Step1
takes 3 parameters
  ```
  action : "step1"
  Amount
  redirect-url
  ```
And returns JSON
```
{
"result":"",
"result-text":"",
"transaction-id":"",
"result-code":"",
"form-url":""
}
```
#### Step 2
Is a HTML form that is created to send the needed fields to the required url. The action of the form needs to be the "form-url" of the JSON returned from step 1. After the form is submitted you will redirect you to the url passed as "redirect-url" in step 1.

The required fields
```
billing-cc-number
billing-cc-exp
billing-cvv
```
#### Step3 
Once on the new page the url will have a parameter named "token-id". Pass "token-id" from the url to step 3.
takes 2 parameter
  ```
  action: "step3"
  token-id
```
And returns JSON
```
{
"result":"",
"result-text":"",
"transaction-id":"",
"result-code":"",
"authorization-code":"",
"cvv-result":"",
"action-type":"",
"amount":"",
"amount-authorized":"",
"tip-amount":"",
"surcharge-amount":"",
"ip-address":"",
"industry":"",
"processor-id":"",
"currency":"",
"tax-amount":"",
"shipping-amount":"",
"billing":{
  "cc-number":"",
  "cc-exp":""
  }
}
```
# Examples
ajaxurl is exposed to the JavaScript and should be used to post to.

#### Step1
```
$.ajax({
    url:    ajaxurl,
    type:   'post',                
    data:   {
        action: "step1",
        amount :5.00,
        'redirect-url': 'https://domainname.com/step2'
    }
  })
  .done( function( response ) { // response from the PHP action
      //response is json object
      //...
      let frm = document.getElementById('frm-step2');
      frm.action = response["form-url"];
  })
```

#### Step 2
The action attribute is set in step 1
```
    <form method="post" id="frm-step2">
        CC#: <input type="text" id="billing-cc-number" name="billing-cc-number" /> <br>
        Exp: <input type="text" id="billing-cc-exp" name="billing-cc-exp" /> <br>
        CVV: <input type="text" id="billing-cvv" name="billing-cvv" /> <br>
        <input type="submit" value="Pay Now!" />
    </form>
```
#### Step 3
This placed on the page that step 2 redirects to
```
const url = new URL(window.location.href);
const tokenId = url.searchParams.get("token-id");

if(typeof tokenId !== "undefined"){
    $.ajax({
        url:    ajaxurl,
        type:   'post',                
        data:   {
            action: "step3",
            'token-id' : tokenId,
            }
    })
    .done( function( response ) { // response from the PHP action
      //response is a JSON object
      //...
    })
}
```



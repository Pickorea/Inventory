<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$d->name}}</title><style>

table {

  font-family: arial, sans-serif;

  /* border-collapse: collapse; */

  width: 100%;

}


td, th {

  /* border: 1px solid #dddddd; */

  text-align: left;

  padding: 8px;

}


/* tr:nth-child(even) {

  background-color: #dddddd;

} */

main {

display: flex;

justify-content: center;

}


table {

max-width: 100%;

}


/* tr:nth-child(odd) {

background-color: #eee;

}  */


th {

/* background-color: #555; */

/* color: #fff; */

}


th,

td {

text-align: left;

padding: 0.2em .5em;}

/* .columnLogo {
            /* font-size: 10px; */
            /* float: left; */
            /* width: 10%; */
            /* margin-right: 10px; */
            /* text-align: center; */
        } */
        /* #columnTitle {
            font-size: 10px;
            float: left;
            width: 68%;
            text-align: center;
        } */
        /* #customer{
            /* font-family: Arial, Helvetica, sans-serif;
            border-collapse: Collapse; */
            /* width: 100%; */
            /* font-size: 13px; */
            /* float: left; */
            /* width: 68%; */
            /* text-align: left; */

               /* } */ */

               /* #customer td, #customer th {
                   border: 1px solid #add;
                   padding: 8px;
                  

                } */

                /* #customer tr:nth-child(even){
                   background-color: #f2f2f2;
                   padding: 8px;

                } */

                /* #customer tr:hover{
                   background-color: #add;
                   padding: 8px;

                } */

                /* #customer tr:nth-child{
                   background-color: #f2f2f2;
                   padding-top: 12px;
                   padding-bottom: 12px;
                   text-align: #4CAF50;
                   color:white;
                   font-size: 26px;

                } */

                table, th, td {

/* border: 0.5px solid black; */

/* border-collapse: collapse; */

}
/* 
th, td {

padding: 10px;

} */
/* 
#services table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

#signature table, th, td {
  /* border: 1px solid red; */
  /* border-collapse: collapse;
} */


</style>

</head>

<body>


<h2>Love from {{$d->description}} [{{$d->name}}] to Kiribati [MFMRD]</h2>
<hr>
<div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full text-center">
          <thead class=".bg-gray-50">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
              Item Names
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
              Quantity
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
              Unit Price
              </th>
            </tr>
          </thead class=".bg-gray-50">
          <tbody>
           @foreach($items as  $item)
            <tr class="bg-white border-b">
            
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{ $item->name }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{ $item->quantity }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
              {{ $item->unit_price }}
              </td>
            </tr class="bg-white border-b">
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<hr>

<!-- <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
        <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Product name
                </th>
                <th scope="col" class="py-3 px-6">
                    Quantity
                </th>
                <th scope="col" class="py-3 px-6">
                    Price
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as  $item)
            <tr class="bg-blue-600 border-b border-blue-400 hover:bg-blue-500">
               
                <td class="py-4 px-6">
                {{ $item->name }}
                </td>
                <td class="py-4 px-6">
                {{ $item->quantity }}
                </td>
                <td class="py-4 px-6">
                {{ $item->unit_price }}
                </td>
               
            </tr>
         @endforeach  
        </tbody>
    </table>
</div> -->

</body>

</html>

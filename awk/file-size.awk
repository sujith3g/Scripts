BEGIN{
    target=".xlsx"
  }
  {
    if($0 ~ target"$"){
      total += $5
      }
    }
END{
  print total/1024/1024 " MB"
  }

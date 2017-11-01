git log | grep Date | less | awk '{print $2 " " $3 " "  $4}' | uniq -c

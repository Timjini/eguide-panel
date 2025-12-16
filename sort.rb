def insertion_sort(arr)
n = arr.length

for i in (1..n)
  key = arr[i]
  j = i - 1

  while j >= 0 and key < arr[j]
    arr[j + 1] = arr[j]
    j -= 1

    arr[j + 1] = key
  end
end

arr

end


array = [5, 7, -2, 8, 9, 0]

p insertion_sort(array)
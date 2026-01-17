
path = r"c:\laragon\www\hiradc-gacor\resources\views\approver\documents\review.blade.php"
with open(path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

# 1-based indices to 0-based:
# Keep 1 to 873 (index 0 to 872)
# Delete 874 to 1056 (index 873 to 1055)
# Keep 1057 to End (index 1056 to end)

part1 = lines[0:873]
part2 = lines[1056:]

new_content = "".join(part1 + part2)

with open(path, 'w', encoding='utf-8') as f:
    f.write(new_content)

print(f"Processed {len(lines)} lines. Removed {1056-873} lines.")

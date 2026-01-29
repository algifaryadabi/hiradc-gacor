// NEW: Update Unit Permissions (AJAX)
public function updateUnitPermissions(Request $request)
{
$request->validate([
'user_id' => 'required|exists:users,id_user',
'is_reviewer' => 'required|boolean',
'is_verifier' => 'required|boolean',
'can_create_doc' => 'required|boolean', // Matches migration
]);

$currentUser = Auth::user();
$targetUser = \App\Models\User::findOrFail($request->user_id);

// Security Check: Use must be Unit Head of same unit
if ($currentUser->id_unit != $targetUser->id_unit || !$currentUser->isKepalaUnit()) {
return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
}

$targetUser->update([
'is_reviewer' => $request->is_reviewer,
'is_verifier' => $request->is_verifier,
'can_create_doc' => $request->can_create_doc,
]);

return response()->json(['success' => true]);
}
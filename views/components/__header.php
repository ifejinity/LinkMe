<div class="bg-primary w-full p-5 fixed top-0 flex justify-between shadow-md items-center z-[2]">
    <h1 class="text-fourth font-[500] text-[18px]"><?php echo $_SESSION["username"] ?></h1>
    <div>
        <!-- logout form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn m-1 btn-sm bg-fourth text-primary hover:bg-fourth/90">Logout</label>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <button type="submit" name="logout">Proceed</button>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</div>
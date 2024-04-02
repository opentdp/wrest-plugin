# @Group: command
# @Roomid: *
# @Phrase: epicfree
# @Level: 9
# @Target: python.exe
# @Remark: 获取今日EPIC免费游戏

import requests

api_url = "https://store-site-backend-static.ak.epicgames.com/freeGamesPromotions?locale=en-US&country=US&allowCountries=US,CN"

r = requests.get(api_url)
if r.status_code == 200:
    print("EPIC免费游戏列表：\n")
    data = r.json()
    for key in data['data']['Catalog']['searchStore']['elements']:
        if key['promotions']:
            if key['promotions']["promotionalOffers"] != []:
                if key['promotions']["promotionalOffers"][0]['promotionalOffers'][0]['discountSetting']['discountPercentage'] == 0:
                    print("{}\n{} -> {}\n".format(key["title"],key['promotions']["promotionalOffers"][0]['promotionalOffers'][0]['startDate'],key['promotions']["promotionalOffers"][0]['promotionalOffers'][0]['endDate']))

else:
    print("EPIC免费游戏列表获取失败")

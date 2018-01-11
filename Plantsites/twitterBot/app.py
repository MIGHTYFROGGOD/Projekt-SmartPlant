# tweepy will allow us to communicate with Twitter, time will allow us to set how often we tweet
import tweepy, time

#enter the corresponding information from your Twitter application management:
CONSUMER_KEY = 'HeDSSy8W5z20L6wjha0f0p5KP' #keep the quotes, replace this with your consumer key
CONSUMER_SECRET = 'V7CbLIesIECMB14JMKvNmHxBxg8bybrYKCRfUkweNeUryDApDl' #keep the quotes, replace this with your consumer secret key
ACCESS_TOKEN = '951009530418286594-3JMxjCb0ISZGFSJlBTAfQBJf4Zj8LUG' #keep the quotes, replace this with your access token
ACCESS_SECRET = '0JUtSceqYi5Y5IUQZ4OVjM79pQjDn7cRP8gRh5SgT7be6' #keep the quotes, replace this with your access token secret


# configure our access information for reaching Twitter
auth = tweepy.OAuthHandler(CONSUMER_KEY, CONSUMER_SECRET)
auth.set_access_token(ACCESS_TOKEN, ACCESS_SECRET)

# access Twitter!
api = tweepy.API(auth)

# open our content file and read each line
filename=open('content.txt')
f=filename.readlines()
filename.close()

# for each line in our contents file, lets tweet that line out except when we hit a error
for line in f:
    try:
        api.update_status(line)
        print("Tweeting!")
    except tweepy.TweepError as err:
        print(err)
    time.sleep(90) #Tweet every 2 minutes
print("All done tweeting!")
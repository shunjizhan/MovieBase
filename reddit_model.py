from __future__ import print_function
from pyspark import SparkConf, SparkContext
from pyspark.sql import SQLContext
from pyspark.ml.feature import CountVectorizer

# IMPORT OTHER MODULES HERE
from cleantext import sanitize
from pyspark.sql.functions import udf
from pyspark.sql.types import ArrayType, StringType


def main(context):
    """Main function takes a Spark SQL context."""
    # YOUR CODE HERE
    # YOU MAY ADD OTHER FUNCTIONS AS NEEDED


def str_to_tokens(comments):
    res_str = ""
    # sanitized_token_list = sanitize(comments)
    for token_str in comments:
        res_str = res_str + ' ' + token_str
        print (res_str.split())
    return res_str.split()


if __name__ == "__main__":
    conf = SparkConf().setAppName("CS143 Project 2B")
    conf = conf.setMaster("local[*]")
    sc = SparkContext(conf=conf)
    sqlContext = SQLContext(sc)
    sc.addPyFile("cleantext.py")

    # Task 1
    # comments = sqlContext.read.json("comments-minimal.json")    # data_frame for comments
    # submissions = sqlContext.read.json("submissions.json")        # data_frame for submissions
    # labeled_data = sqlContext.read.load("labeled_data.csv", format="csv", sep=",", inferSchema="true", header="true")

    # comments.write.parquet("comments.parquet")
    # submissions.write.parquet("submissions.parquet")
    # labeled_data.write.parquet("labeled_data.parquet")

    comments = sqlContext.read.parquet("comments.parquet")
    submissions = sqlContext.read.parquet("submissions.parquet")
    labeled_data = sqlContext.read.parquet("labeled_data.parquet")
    # comments.show()
    # print('*' * 50)
    # submissions.show()

    # Task 2
    comments.createOrReplaceTempView("comments_view")           # Register the df as a SQL temporary view
    submissions.createOrReplaceTempView("submissions_view")
    labeled_data.createOrReplaceTempView("labeled_data_view")

    # labelded_comments = sqlContext.sql("  SELECT id, body, labeldem, labelgop, labeldjt FROM comments_view, labeled_data_view WHERE id = Input_id LIMIT 10")
    labelded_comments = sqlContext.sql("SELECT id, body, labeldjt FROM comments_view, labeled_data_view WHERE id = Input_id")
    # labelded_comments.show()
    # labelded_comments.printSchema()

    # comments_arr = labelded_comments.select("body").rdd.flatMap(lambda x: x).collect()
    # grams = []
    # for i in range(len(comments_arr)):
    #     return_list = []
    #     sanitized_token_list = sanitize(comments_arr[i])
    #     for token_str in sanitized_token_list:
    #         lst = token_str.split()
    #         return_list+= lst
    #     grams.append(return_list)

    # Task 4
    # sqlContext.udf.register("grams", str_to_tokens, StringType())
    udfValueToGrams = udf(sanitize, ArrayType(StringType()))
    labelded_comments = labelded_comments.withColumn("grams", udfValueToGrams("body"))
    labelded_comments.show()

    # # Task 5
    udfGramsToToken = udf(str_to_tokens, ArrayType(StringType()))
    labelded_comments = labelded_comments.withColumn("tokens", udfGramsToToken("grams"))
    labelded_comments.show()



    # Task 6 A
    # cv = CountVectorizer(inputCol='tokens', outputCol='features', binary=True, minDF=5)
    
    # model = cv.fit(labelded_comments)
    # result = model.transform(labelded_comments)

    # result.show()
